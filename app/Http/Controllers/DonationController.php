<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    protected $xenditService;

    public function __construct()
    {
        // Initialize XenditService only when needed
    }

    /**
     * Create donation and generate Xendit invoice
     */
    public function createDonation(Request $request)
    {
        try {
            // Validate request first
            $request->validate([
                'campaign_id' => 'required|exists:campaigns,id',
                'amount' => 'required|numeric|min:10000',
                'donor_name' => 'required|string|max:255',
                'donor_email' => 'required|email',
                'message' => 'nullable|string|max:500',
            ]);

            $campaign = Campaign::findOrFail($request->campaign_id);
            
            // Calculate trees count based on amount
            $treesCount = intval($request->amount / $campaign->tree_price);
            
            if ($treesCount < 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jumlah donasi minimal Rp ' . number_format($campaign->tree_price),
                ], 422);
            }

            // Create external ID
            $externalId = 'donation-' . time() . '-' . random_int(1000, 9999);

            // Create donation record with pending status
            $donation = Donation::create([
                'user_id' => Auth::id(),
                'campaign_id' => $request->campaign_id,
                'amount' => $request->amount,
                'trees_count' => $treesCount,
                'external_id' => $externalId,
                'status' => 'pending',
                'donor_name' => $request->donor_name,
                'donor_email' => $request->donor_email,
                'message' => $request->message,
            ]);

            \Log::info('Donation created', [
                'donation_id' => $donation->id,
                'external_id' => $externalId,
                'amount' => $request->amount,
            ]);

            // Create Xendit service and invoice
            $xenditService = new XenditService();
            
            $invoice = $xenditService->createInvoice(
                $externalId,
                (int) $request->amount,
                "Donasi untuk kampanye: {$campaign->title}"
            );

            \Log::info('Xendit invoice created', [
                'invoice_id' => $invoice['id'],
                'donation_id' => $donation->id,
            ]);

            // Update donation with invoice ID
            $donation->update([
                'xendit_invoice_id' => $invoice['id'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Invoice berhasil dibuat',
                'invoice_url' => $invoice['invoice_url'],
                'invoice_id' => $invoice['id'],
                'donation_id' => $donation->id,
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('Donation validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
            
        } catch (\Exception $e) {
            \Log::error('Donation Error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat invoice: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get donation details
     */
    public function getDonation($donationId)
    {
        $donation = Donation::with(['campaign', 'user'])->findOrFail($donationId);

        return response()->json([
            'status' => 'success',
            'data' => $donation,
        ]);
    }

    /**
     * Get campaign donations
     */
    public function getCampaignDonations($campaignId)
    {
        $donations = Donation::where('campaign_id', $campaignId)
            ->where('status', 'paid')
            ->with(['user'])
            ->latest()
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $donations,
        ]);
    }

    /**
     * Show user donations page
     */
    public function myDonations()
    {
        $donations = Donation::where('user_id', Auth::id())
            ->with(['campaign'])
            ->latest()
            ->paginate(10);

        return view('my-donations', compact('donations'));
    }

    /**
     * Show donation success page
     */
    public function showSuccess($donationId)
    {
        $donation = Donation::with(['campaign'])->findOrFail($donationId);

        // Check if donation is paid
        if ($donation->status !== 'paid') {
            return redirect()->route('kampanye.show', $donation->campaign)
                ->with('error', 'Donasi belum terbayar');
        }

        return view('donation-success', compact('donation'));
    }

    /**
     * Check donation status
     */
    public function checkStatus($donationId)
    {
        $donation = Donation::findOrFail($donationId);

        return response()->json([
            'status' => 'success',
            'data' => [
                'donation_id' => $donation->id,
                'payment_status' => $donation->status,
                'amount' => $donation->amount,
                'trees_count' => $donation->trees_count,
                'campaign_id' => $donation->campaign_id,
            ],
        ]);
    }
}
