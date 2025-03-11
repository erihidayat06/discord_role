<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index()
    {
        return view('payment');
    }

    public function process(Request $request)
    {
        $paymentType = $request->input('payment_type'); // Ambil metode pembayaran yang dipilih

        $order_id = uniqid();
        $amount = 150000;

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '08123456789',
            ],
            'enabled_payments' => [$paymentType] // Gunakan metode pembayaran yang dipilih
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function notification(Request $request)
    {
        $json = json_decode($request->getContent(), true);

        if ($json['transaction_status'] == 'settlement') {
            // Update database (pesanan sukses)
        }

        return response()->json(['status' => 'success']);
    }
}
