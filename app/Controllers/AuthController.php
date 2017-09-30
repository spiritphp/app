<?php

namespace App\Controllers;

use App\Models\User;
use Spirit\Auth;
use Spirit\Engine;
use Spirit\Request;
use Spirit\Response\Redirect;
use Spirit\Services\Mail;
use Spirit\Services\Validator;
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

    public function login(Request $request)
    {
        $requestData = $request->only('email', 'is_remember');

        $error = Request\Session::get('error');
        if ($request->isPOST()) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->check()) {
                if (Auth::authorize($request->only('email', 'password'), !!$request->get('is_remember'))) {
                    return $this->redirect('/');
                }
            }

            $error = 'We couldn\'t verify your credentials.';
            return $this->redirect()->back()->with('error', $error);
        }

        return $this->view('auth/login', [
            'old' => $requestData,
            'error' => $error
        ]);
    }

    public function join(Request $request)
    {
        $requestData = $request->only('email');

        $error = null;
        if ($request->isPOST()) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if ($validator->check()) {
                Auth::register($request->only('email', 'password'));
                return $this->redirect('/');
            } else {
                $error = $validator->getAllError();
            }
        }

        return $this->view('auth/join', [
            'old' => $requestData,
            'error' => $error
        ]);
    }

    public function activation($code)
    {
        if ($user = Activation::make()->setCode($code)->activate()) {
            Auth::setUserCookie($user->id);
            return Redirect::home();
        }

        return Redirect::to('login');
    }

    public function resetPassword(Request $request, $hash)
    {
        $recoveryService = Auth\DefaultDriver\Recovery::token($hash);

        if (!$recoveryService) {
            $this->abort(404);
        }

        $error = null;

        if ($request->isPOST()) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed'
            ]);
            $validator->customError('password','The passwords must match');

            if ($validator->check()) {
                $recovery = $recoveryService->get();
                Auth\DefaultDriver\Password::set($recovery->user, $request->get('password'));
                $recoveryService->use();
                Auth::loginById($recovery->user->id);
                return $this->redirect('/');
            }

            $error = $validator->getAllError();
        }

        return $this->view('auth/reset-password', [
            'error' => $error
        ]);
    }

    public function recovery(Request $request)
    {
        $error = null;
        $success = null;
        if ($request->isPOST()) {
            $validator = Validator::make($request->only('email'), [
                'email' => 'required|email'
            ]);

            if ($validator->check()) {
                $email = $request->get('email');

                /**
                 * @var User $user
                 */
                if ($user = User::where('email', $email)->first()) {
                    $recovery = Auth\DefaultDriver\Recovery::user($user)->get();

                    Mail::send(
                        'auth.email.recovery',
                        [
                            'link' => route('reset_password', $recovery->token),
                            'url' => Engine::i()->domain
                        ],
                        function(Mail\Message $message) use ($user, $recovery) {
                            $message->to($user->email)
                                ->subject('Reset Password');
                        });

                    $success = true;
                } else {
                    $error = 'We can\'t find a user with that e-mail address.';
                }

            } else {
                $error = $validator->getFirstErrorForAttr('email');
            }
        }

        return $this->view('auth/recovery', [
            'error' => $error,
            'success' => $success
        ]);
    }

}