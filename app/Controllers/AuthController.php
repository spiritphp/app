<?php

namespace App\Controllers;

use App\Models\User;
use Spirit\Auth;
use Spirit\Engine;
use Spirit\Request;
use Spirit\Response\Redirect;
use Spirit\Services\Mail;
use Spirit\Structure\Controller;

class AuthController extends Controller
{
    public function logout()
    {
        if (Auth::guest()) {
            $this->abort(404);
        }

        Auth::logout();

        return $this->redirect('/');
    }

    public function loginGet()
    {
        return $this->view('auth/login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email' => 'Email',
            'password' => 'Password'
        ]);

        if (!Auth::authorize($request->only('email', 'password'), !!$request->get('is_remember'))) {
            return $this->redirect()
                ->back()
                ->withErrors(['We couldn\'t verify your credentials.'])
                ->withInputs();
        }

        return $this->redirect('/');
    }

    public function joinGet()
    {
        return $this->view('auth/join');
    }

    public function joinPost(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ],
            [
                'email' => 'Email',
                'password' => 'Password'
            ]
        );

        Auth::register($request->only('email', 'password'));
        return $this->redirect('/');
    }

    public function resetPasswordGet($hash)
    {
        $recoveryService = Auth\DefaultDriver\Recovery::token($hash);

        if (!$recoveryService) {
            $this->abort(404);
        }

        return $this->view('auth/reset-password');
    }

    public function resetPasswordPost(Request $request, $hash)
    {
        $recoveryService = Auth\DefaultDriver\Recovery::token($hash);

        if (!$recoveryService) {
            $this->abort(404);
        }

        $request->validate(
            [
                'password' => 'required|confirmed'
            ],
            [
                'password' => 'Password',
                'password_confirmation' => 'Confirm password'
            ]
        );

        $recovery = $recoveryService->get();
        Auth\DefaultDriver\Password::set($recovery->user, $request->get('password'));
        $recoveryService->use();

        Auth::loginById($recovery->user->id);

        return $this->redirect('/');
    }

    public function recoveryGet(Request $request)
    {
        return $this->view('auth/recovery');
    }

    public function recoveryPost(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
            ],
            [
                'email' => 'Email'
            ]
        );

        /**
         * @var User $user
         */
        if (!$user = User::where('email', $request->get('email'))
            ->first()) {
            return $this->redirect()
                ->back()
                ->withErrors([
                    'We can\'t find a user with that e-mail address.'
                ]);
        }

        $recovery = Auth\DefaultDriver\Recovery::user($user)
            ->get();

        Mail::send(
            'auth.email.recovery',
            [
                'link' => route('reset_password', $recovery->token, true),
                'url' => Engine::i()->domain
            ],
            function(Mail\Message $message) use ($user, $recovery) {
                $message->to($user->email)
                    ->subject('Reset Password');
            });

        return $this->redirect()
            ->back()
            ->with('success', 1);
    }

}