<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Keanggotaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Validasi request
        if (!$request->has('keanggotaan_id') || !$request->has('payment_type')) {
            return response()->json(['error' => 'Data tidak lengkap'], 400);
        }

        $keanggotaan = Keanggotaan::find($request->keanggotaan_id);
        if (!$keanggotaan) {
            return response()->json(['error' => 'Keanggotaan tidak ditemukan'], 404);
        }

        $orderId = 'ORDER-' . uniqid();
        $grossAmount = $keanggotaan->harga_setahun * $keanggotaan->bulan;
        $paymentType = $request->payment_type;



        // Konfigurasi transaksi ke Midtrans
        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => [
                [
                    'id' => $keanggotaan->id,
                    'price' => $keanggotaan->harga_setahun * $keanggotaan->bulan,
                    'quantity' => 1,
                    'name' => "Peket " . $keanggotaan->bulan . " Bulan",
                ],
            ],
            'customer_details' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->no_tlp,
            ],

            'enabled_payments' => [$paymentType], // Menentukan metode pembayaran
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);
            // Simpan order ke database
            $order = Order::create([
                'order_id' => $orderId,
                'user_id' => auth()->id(),
                'keanggotaan_id' => $keanggotaan->id,
                'amount' => $grossAmount,
                'status' => 'pending',
                'token' => $snapToken,
                'type' => $paymentType,
            ]);
            return response()->json([
                'token' => $snapToken,
                'order_id' => $order->order_id,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function notification(Request $request)
    {
        $json = json_decode($request->getContent(), true);

        if (!isset($json['order_id']) || !isset($json['transaction_status'])) {
            return response()->json(['error' => 'Invalid notification data'], 400);
        }

        $order = Order::where('order_id', $json['order_id'])->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $user = User::find($order->user_id);
        $keanggotaan = Keanggotaan::find($order->keanggotaan_id);

        if (!$user || !$keanggotaan) {
            return response()->json(['error' => 'User or Keanggotaan not found'], 404);
        }

        $status = $json['transaction_status'];

        if ($status == 'settlement') {
            // Pastikan `bulan` adalah integer sebelum dikalikan dengan 30
            $jumlahHari = (int) $keanggotaan->bulan * 30;

            // Pastikan tanggal expired tidak berkurang jika diperpanjang
            $currentExpired = $user->expired && Carbon::parse($user->expired)->gt(now())
                ? Carbon::parse($user->expired)
                : now();

            $newExpired = $currentExpired->addDays($jumlahHari);

            $user->update(['expired' => $newExpired]);

            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            // Kirim event ke Facebook Pixel
            try {
                $this->sendFacebookPixelEvent($user, $order, 'Purchase');
            } catch (\Exception $e) {
                Log::error('Facebook Pixel Error: ' . $e->getMessage());
            }
        } elseif (in_array($status, ['expire', 'cancel', 'failure'])) {
            $order->update(['status' => 'failed']);

            // Kirim event ke Facebook Pixel
            try {
                $this->sendFacebookPixelEvent($user, $order, 'PurchaseFailed');
            } catch (\Exception $e) {
                Log::error('Facebook Pixel Error: ' . $e->getMessage());
            }
        }

        return response()->json(['status' => 'success']);
    }


    private function sendFacebookPixelEvent($user, $order, $event)
    {
        try {
            $pixelId = pixel()->pixel;
            $accessToken = pixel()->token;

            if (!$pixelId || !$accessToken) {
                return;
            }

            $response = Http::post("https://graph.facebook.com/v18.0/{$pixelId}/events", [
                'access_token' => $accessToken,
                'data' => [
                    [
                        'event_name' => $event,
                        'event_time' => time(),
                        'user_data' => [
                            'em' => [hash('sha256', strtolower($user->email))], // Hash email
                            'ph' => [hash('sha256', $user->no_tlp)], // Hash nomor HP
                        ],
                        'custom_data' => [
                            'value' => $order->amount,
                            'currency' => 'IDR',
                            'content_name' => "Order {$order->order_id}",
                            'content_category' => 'Subscription',
                            'content_ids' => [$order->order_id],
                        ],
                        'event_source_url' => url('/'),
                        'action_source' => 'website'
                    ]
                ]
            ]);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Facebook Pixel API Error: ' . $e->getMessage());
        }
    }




    public function getToken($orderId)
    {
        try {
            // Ambil data order berdasarkan ID
            $order = Order::with('user')->findOrFail($orderId);

            // Pastikan metode pembayaran tersedia di order
            if (!$order->type) {
                return response()->json(['error' => 'Metode pembayaran tidak ditemukan'], 400);
            }

            // Jika token sudah tersedia, langsung kembalikan tanpa request baru ke Midtrans
            if (!empty($order->token)) {
                Log::info("Token ditemukan untuk Order ID: {$order->order_id}");
                return response()->json(['token' => $order->token]);
            }

            // Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Konversi metode pembayaran jika format tidak sesuai
            $paymentType = strtolower($order->type);
            $validPayments = ['credit_card', 'gopay', 'bank_transfer', 'bca_va', 'bni_va', 'permata_va'];

            if (!in_array($paymentType, $validPayments)) {
                return response()->json(['error' => 'Metode pembayaran tidak valid'], 400);
            }

            // Pastikan amount adalah integer
            $grossAmount = intval($order->amount);

            // Pastikan user terkait tersedia
            if (!$order->user) {
                return response()->json(['error' => 'Data pengguna tidak ditemukan'], 400);
            }

            // Buat transaksi Midtrans
            $transaction = [
                'transaction_details' => [
                    'order_id' => $order->order_id,
                    'gross_amount' => $grossAmount,
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                ],
                'enabled_payments' => [$paymentType],
            ];

            Log::info('Midtrans Request:', $transaction);

            // Dapatkan token pembayaran
            $snapToken = Snap::getSnapToken($transaction);

            // Simpan token ke database agar bisa digunakan kembali
            $order->token = $snapToken;
            $order->save();

            return response()->json(['token' => $snapToken]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Order tidak ditemukan: {$orderId}");
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        } catch (\Exception $e) {
            Log::error("Midtrans Error (Order ID: {$orderId}): " . $e->getMessage());
            return response()->json(['error' => 'Gagal mendapatkan token pembayaran', 'details' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();

        if ($order) {
            $order->update(['status' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Status diperbarui']);
        }

        return response()->json(['success' => false, 'message' => 'Order tidak ditemukan'], 404);
    }

    public function webhook(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['order_id'])) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $order = Order::where('order_id', $data['order_id'])->first();

        if ($order) {
            switch ($data['transaction_status']) {
                case 'settlement':  // Berhasil
                    $order->update(['status' => 'paid', 'paid_at' => now()]);
                    break;
                case 'pending':  // Menunggu pembayaran
                    $order->update(['status' => 'pending']);
                    break;
                case 'expire':  // Kedaluwarsa
                case 'cancel':  // Dibatalkan
                case 'failure':  // Gagal
                    $order->update(['status' => 'failed']);
                    break;
            }
        }

        return response()->json(['message' => 'Webhook received']);
    }
}
