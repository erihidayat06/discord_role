<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Period;
use App\Models\ProfilWeb;
use App\Models\Keanggotaan;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {

        // Cek apakah ada data profil, kalau tidak ada buat default
        $profil = ProfilWeb::first();

        if (!$profil) {
            $profil = ProfilWeb::create([
                'nama_website' => 'Nama Website',
                'logo' => '',
                'bunny_stream_library_id' => '',
                'bunny_stream_api_key' => '',
                'bunny_stream_watermark_url' => '',
                'cloudflare_site_key' => '',
                'cloudflare_secret_key' => '',
                'midtrans_merchant_id' => '',
                'midtrans_client_key' => '',
                'midtrans_server_key' => '',
                'midtrans_url' => '',
                'midtrans_is_production' => false,
            ]);
        }

        $period = Period::firstOrCreate([], [
            'periode' => now(),
        ]);


        $keanggotaans = Keanggotaan::get();
        return view('index', ['keanggotaans' => $keanggotaans, 'periode' => $period]);
    }
}
