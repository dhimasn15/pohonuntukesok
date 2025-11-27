<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\XenditService;

class PaymentController extends Controller
{
    public function createInvoice(Request $request)
    {
        $xendit = new XenditService();

        $invoice = $xendit->createInvoice(
            'pesanan-' . time(),
            $request->amount,
            'Donasi PohonUntukEsok'
        );

        return response()->json([
            'status' => 'success',
            'invoice_url' => $invoice['invoice_url'],
            'invoice_id' => $invoice['id']
        ]);
    }
}
