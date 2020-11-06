<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }



    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $user->token;
        

        $newUser = new User();
        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->password = $user->token;
        $newUser->save();

        Auth::login($newUser, true);
        
        return view('welcome');
    }
}
