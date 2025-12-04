<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class XenditWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Log untuk debugging
        Log::info('Xendit Webhook Received', $request->all());

        try {
            $data = $request->all();

            // Handle invoice notification
            if (isset($data['id']) && isset($data['status'])) {
                $invoiceId = $data['id'];
                $status = $data['status'];

                // Find donation by xendit invoice ID
                $donation = Donation::where('xendit_invoice_id', $invoiceId)->first();

                if (!$donation) {
                    Log::warning('Donation not found for invoice: ' . $invoiceId);
                    return response()->json(['message' => 'OK']);
                }

                // Update donation status based on payment status
                if ($status === 'PAID') {
                    DB::transaction(function () use ($donation, $data) {
                        // Mark donation as paid and create farmer plant order
                        $donation->markAsPaid();

                        Log::info('Donation marked as paid and order created', [
                            'donation_id' => $donation->id,
                            'campaign_id' => $donation->campaign_id,
                            'trees_count' => $donation->trees_count,
                        ]);
                    });

                    // Store success message in cache for redirect
                    \Cache::put('donation_success_' . $donation->id, [
                        'campaign_title' => $donation->campaign->title,
                        'trees_count' => $donation->trees_count,
                        'amount' => $donation->amount,
                        'timestamp' => now(),
                    ], now()->addMinutes(5));

                } elseif ($status === 'EXPIRED') {
                    $donation->update(['status' => 'expired']);
                    Log::info('Donation expired', ['donation_id' => $donation->id]);
                } elseif (in_array($status, ['PENDING', 'SETTLED'])) {
                    $donation->update(['status' => 'pending']);
                }
            }

            return response()->json(['message' => 'OK']);

        } catch (\Exception $e) {
            Log::error('Xendit Webhook Error: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return response()->json(['message' => 'Error processing webhook'], 500);
        }
    }
}
