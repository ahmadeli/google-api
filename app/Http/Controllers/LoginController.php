<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();

    }

    public function handleProviderCallback($provider){

        $socialiteUser=Socialite::driver($provider)->user();
        $user= User::firstorcreate(
           [
               'provider_id'=> $socialiteUser->getid(),
           ],
           [
               'email'=> $socialiteUser->getEmail(),
               'name'=> $socialiteUser->getName(),
           ]
            

        );

    }
}
