<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Repositories\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Authenticatable;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_token', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended('/students');
            } else {
                $newUser = User::create([
                    'email' => $user->email,
                    'google_token' => $user->id,
                    'password' => bcrypt('motdentam'),
                    'type' => 'Student'
                ]);

                Auth::login($newUser);

                return redirect()->intended('/students');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
