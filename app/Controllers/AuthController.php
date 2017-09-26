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

    public function login(Request\RequestProvider $request)
    {
        $requestData = $request->only('email', 'is_remember');

        $error = null;
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
        }

        return $this->view('auth/login', [
            'old' => $requestData,
            'error' => $error
        ]);
    }

    public function join()
    {
        $request = Request::only('email');

        $error = null;
        if (Request::isPOST()) {

            $validator = Validator::make(Request::all(), [
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if ($validator->check()) {
                Auth::register(Request::only('email', 'password'));
                return $this->redirect('/');
            } else {
                $error = $validator->getAllError();
            }
        }

        return $this->view('auth/join', [
            'old' => $request,
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

    public function resetPassword(Request\RequestProvider $request, $hash)
    {
        $recovery = Auth\DefaultDriver\Recovery::make()->initForToken($hash)->get();

        if (!$recovery) {
            $this->abort(404);
        }

        $error = null;

        if ($request->isPOST()) {

        }


        return $this->view('auth/reset-password', [
            'error' => $error
        ]);
    }

    public function recovery()
    {
        $error = null;
        $success = null;
        if (Request::isPOST()) {
            $validator = Validator::make(Request::only('email'), [
                'email' => 'required|email'
            ]);

            if ($validator->check()) {
                $email = Request::get('email');

                /**
                 * @var User $user
                 */
                if ($user = User::where('email', $email)->first()) {
                    $recovery = Auth\DefaultDriver\Recovery::user($user)->init()->get();

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