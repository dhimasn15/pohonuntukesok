<?php

namespace App\Services;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Illuminate\Support\Facades\Log;

class XenditService
{
    private $apiKey;
    private $invoiceApi;

    public function __construct()
    {
        $this->apiKey = env('XENDIT_API_KEY');
        
        if (empty($this->apiKey)) {
            Log::error('XENDIT_API_KEY not found in environment variables');
            throw new \Exception('XENDIT_API_KEY is not configured');
        }

        try {
            // Setup configuration
            $config = Configuration::getDefaultConfiguration()
                ->setApiKey($this->apiKey);

            // Create InvoiceApi instance
            $this->invoiceApi = new InvoiceApi(
                null,
                $config
            );

            Log::info('XenditService initialized successfully');
        } catch (\Exception $e) {
            Log::error('Failed to initialize Xendit service: ' . $e->getMessage());
            throw new \Exception('Failed to initialize Xendit service: ' . $e->getMessage());
        }
    }

    /**
     * Create invoice
     *
     * @param string $externalId - External ID untuk referensi
     * @param int $amount - Amount dalam Rupiah
     * @param string $description - Deskripsi invoice
     * @param string $successUrl - URL untuk redirect setelah pembayaran sukses
     * @return array - Invoice details
     * @throws \Exception
     */
    public function createInvoice($externalId, $amount, $description = "Invoice", $successUrl = null)
    {
        try {
            // Validate inputs
            if (empty($externalId) || empty($amount) || empty($description)) {
                throw new \Exception('Missing required parameters for invoice creation');
            }

            $amount = (int) $amount;
            
            if ($amount < 10000) {
                throw new \Exception('Minimum invoice amount is Rp 10,000');
            }

            Log::info('Creating Xendit invoice', [
                'external_id' => $externalId,
                'amount' => $amount,
                'description' => $description,
            ]);

            // Generate redirect URLs if not provided
            if (empty($successUrl)) {
                $successUrl = url('/donation-success-check');
            }

            // Create invoice request object
            $createInvoiceRequest = new CreateInvoiceRequest([
                'external_id' => $externalId,
                'amount' => $amount,
                'description' => $description,
                'invoice_duration' => 86400, // 24 hours
                'success_redirect_url' => $successUrl,
                'failure_redirect_url' => url('/'),
            ]);

            // Call API
            $invoice = $this->invoiceApi->createInvoice($createInvoiceRequest);

            Log::info('Xendit invoice created successfully', [
                'invoice_id' => $invoice->getId(),
                'external_id' => $externalId,
                'invoice_url' => $invoice->getInvoiceUrl(),
            ]);

            // Convert to array for compatibility
            return [
                'id' => $invoice->getId(),
                'external_id' => $invoice->getExternalId(),
                'amount' => $invoice->getAmount(),
                'invoice_url' => $invoice->getInvoiceUrl(),
                'status' => $invoice->getStatus(),
                'created' => $invoice->getCreated(),
                'updated' => $invoice->getUpdated(),
            ];

        } catch (\Exception $e) {
            Log::error('Error creating Xendit invoice', [
                'error' => $e->getMessage(),
                'external_id' => $externalId,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }
}
