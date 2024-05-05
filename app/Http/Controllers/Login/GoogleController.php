<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('google_token', $user->id)->first();
            Session::put('userinfo',$user->email);

            if ($findUser) {
                Auth::login($findUser);

                return redirect()->intended('/students')->with([
                    'success' => 'Chào mừng sinh viên ' . ' ' . $user->email,
                ]);
            } else {
                $newUser = User::create([
                    'email' => $user->email,
                    'google_token' => $user->id,
                    'password' => bcrypt('motdentam'),
                    'type' => 'Student'
                ]);

                Auth::login($newUser);

                return redirect()->intended('/students')->with('success', 'Chào mừng sinh viên ' . ' ' . $newUser->email);
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
