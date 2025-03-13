<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Keanggotaan;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {

        dd([
            'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
            'client_key' => env('MIDTRANS_CLIENT_KEY'),
            'server_key' => env('MIDTRANS_SERVER_KEY'),
            'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
            'snap_url' => env('MIDTRANS_URL'),
        ]);
        $period = Period::firstOrCreate([], [
            'periode' => now(),
        ]);


        $keanggotaans = Keanggotaan::get();
        return view('index', ['keanggotaans' => $keanggotaans, 'periode' => $period]);
    }
}
