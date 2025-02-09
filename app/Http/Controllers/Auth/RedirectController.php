<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class RedirectController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('discord')
            ->scopes(['scope' => 'identify email guilds.join'])
            ->redirect();
    }
}
