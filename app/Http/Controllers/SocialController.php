<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Providers\SocialAccountServiceProvider;

use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function login($provider)
    {
        return Socialite::with($provider)->redirect();
    }
    public function logout()
    {
        \Auth::logout();
        return redirect(route('dashboard'));
    }

    public function callback(SocialAccountServiceProvider $service, $provider)
    {

        $driver = Socialite::driver($provider);
        $user = $service->createOrGetUser($driver, $provider);
        \Auth::login($user, true);
        return redirect()->intended('/dashboard');

    }

}