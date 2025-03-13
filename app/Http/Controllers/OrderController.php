<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Keanggotaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        return view('orderan');
    }

    public function cetak($id)
    {
        $order = Order::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('orders.invoice', compact('order'));

        return $pdf->stream("Invoice_{$order->order_id}.pdf");
    }

    public function orderUser()
    {
        return view('user.order');
    }
    public function perpanjangUser()
    {
        $keanggotaans = Keanggotaan::get();
        return view('user.perpanjang', ['keanggotaans' => $keanggotaans]);
    }
}
