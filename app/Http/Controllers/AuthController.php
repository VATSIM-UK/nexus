<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('vatsimuk')->redirect();
    }

    public function callback()
    {
        $socialiteUser = Socialite::driver('vatsimuk')->user();

        // Authorise CID
        $whitelistedCids = config('auth.cid_whitelist');
        if (! in_array($socialiteUser->getId(), $whitelistedCids)) {
            return redirect('/')->withErrors("You aren't able to sign in to Nexus at the moment.");
        }

        $user = User::updateOrCreate(
            [
                'vatsim_cid' => $socialiteUser->getId(),
            ],
            [
                'first_name' => $socialiteUser->first_name,
                'last_name' => $socialiteUser->last_name,
                'email' => $socialiteUser->getEmail(),
            ]
        );

        Auth::login($user, true);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
