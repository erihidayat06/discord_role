<?php

namespace App\Http\Controllers;

use App\Models\Keanggotaan;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $keanggotaans = Keanggotaan::get();
        return view('index', ['keanggotaans' => $keanggotaans]);
    }
}
