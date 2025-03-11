<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Keanggotaan;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $period = Period::firstOrCreate([], [
            'periode' => now(),
        ]);
        $keanggotaans = Keanggotaan::get();
        return view('index', ['keanggotaans' => $keanggotaans, 'periode' => $period]);
    }
}
