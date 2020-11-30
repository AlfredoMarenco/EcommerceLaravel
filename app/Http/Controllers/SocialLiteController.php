<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialLiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $user->token;
        $newUser = new User();
        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->password = $user->token;
        $emailValidation = User::where('email', $user->getEmail())->count();
        
        if ($emailValidation != 0) {
            Auth::login($newUser,true);
            return redirect('dashboard');
        } else {
            $newUser->save();
            Auth::login($newUser, true);
        }

        return view('welcome');
    }
}
