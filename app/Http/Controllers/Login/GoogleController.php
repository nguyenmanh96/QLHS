<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Repository\UserRepository;


class GoogleController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $googleToken = $user->id;
            $findUser = $this->userRepository->findByGoogleToken($googleToken);

            if (!$findUser) {
                $userData = [
                    'email' => $user->email,
                    'google_token' => $user->id,
                    'type' => 'Student'
                ];
                $findUser = $this->userRepository->create($userData);
            }

            Auth::login($findUser);

            return redirect()->intended('/students')->with([
                'success' => __('messages.welcome') . ' ' . $user->email,
            ]);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
