<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkademiController extends Controller
{
    public function index()
    {
        return view('akademi');
    }
}
