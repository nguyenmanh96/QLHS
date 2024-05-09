<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Repositories\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ForgotController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getFormForgot()
    {
        return view('guest.forgot');
    }

    public function sendResetPassword(Request $request)
    {
        $info = $request->email;
        $user = $this->userRepository->findByEmail($info);

        if (!empty($user)) {
            $user->remember_token = Str::random(40);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
        }

        return redirect()->back()->with('success', __('messages.sent_link'));
    }

    public function getFormReset($token)
    {
        $user = $this->userRepository->findByRememberToken($token);

        if (!empty($user)) {
            $data['user'] = $user;
            return view('guest.reset', $data, ['token' => $token]);
        } else {
            return view('404');
        }

    }

    public function resetPassword($token, Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'max:24'],
        ], [
            'password.required' => __('validation.password_required'),
            'password.string' => __('validation.password_string'),
            'password.min' => __('validation.password_min', ['min' => 8]),
            'password.max' => __('validation.password_max', ['min' => 24]),
        ]);

        $user = $this->userRepository->findByRememberToken($token);

        if (!empty($user)) {
            if ($request->password == $request->confirm_password) {
                $user->password = bcrypt($request->password);
                if (empty($user->email_verified_at)) {
                    $user->email_verified_at = date('Y-m-d H:i:s ');
                }
                $user->remember_token = str::random(40);
                $user->save();

                return redirect('login')->with('success_reset', __('messages.change_done'));
            } else {
                return redirect()->back()->with('error_reset', __('messages.conflict_pw'))->withInput($request->only('password'));
            }
        } else {
            return view('404');
        }
    }


}
