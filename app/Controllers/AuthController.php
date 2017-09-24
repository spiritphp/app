<?php

namespace App\Controllers;

use Spirit\Auth;
use Spirit\Engine;
use Spirit\Request;
use Spirit\Response\Redirect;
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
    }

    public function login()
    {
        $request = Request::only('email','is_remember');

        $error = null;
        if (Request::isPOST()) {

            $validator = Validator::make(Request::all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->check()) {
                Auth::authorize(Request::only('email','password'), !!Request::get('is_remember'));
                return $this->redirect('/');
            }

            $error = 'We couldn\'t verify your credentials.';
        }

        return $this->view('auth/login',[
            'old' => $request,
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
                Auth::register(Request::only('email','password'));
                return $this->redirect('/');
            } else {
                $error = $validator->getAllError();
            }
        }

        return $this->view('auth/join',[
            'old' => $request,
            'error' => $error
        ]);
    }

    public function registration()
    {
        $form = Form::make()
            ->text('login', 'Никнейм', 'required|unique:users,login')
            ->text('email', 'Электронная почта', 'email|unique:users,email')
            ->password('password', 'Пароль', 'required')
            ->protectCaptcha(1)
            ->submit('Регистрация');

        $form->setError(
            [
                'login' => [
                    'required' => 'Введите никнейм',
                    'unique' => 'Указанный никнейм занят'
                ],
                'email' => [
                    'required' => 'Чтобы зарегистрироваться, нужно ввести электронную почту',
                    'email' => 'Вы указали неверную электронную почту',
                    'unique' => 'Указанная электронная почта уже зарегистрирована'
                ],
                'password' => [
                    'required' => 'Вы не ввели пароль',
                ],
            ]
        );

        if ($form->check()) {
            $d = $form->getData();
            $user = Registration::make()
                ->setLogin($d['login'])
                ->setEmail($d['email'])
                ->setPassword($d['password'])
                ->withActivation()
                ->sendActivation('Активация', Engine::dir()->views . 'auth/email/activation.php')
                ->sendWelcome('Регистрация', Engine::dir()->views . 'auth/email/registration.php')
                ->create();

            Auth::setUserCookie($user->id);
            return Redirect::home();
        }

        return $this->view('auth/registration',[
            'form' => $form
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

    public function recovery($hash = false)
    {
        if ($hash) {
            $r = Recovery::make()->setHash($hash);

            if ($r->check()) {
                $form = Form::make()
                    ->text('password', 'Новый пароль', 'required|confirmed')
                    ->text('password_confirmation', 'Повторите пароль', 'required')
                    ->submit('Сменить пароль');

                $form->setError(
                    [
                        'password' => [
                            'required' => 'Введите пароль',
                        ]
                    ]
                );

                if ($form->check()) {

                    if ($r->setNewPassword($form->get('password'))) {
                        $user_id = $r->getUserID();
                        Auth::setUserCookie($user_id);
                        return Redirect::home();
                    }

                }

                $data = [
                    'form' => $form
                ];

                return $this->view('recoverysetpassword', $data);
            }
        }

        $form = Form::make()
            ->text('login', 'Логин или электронная почта', 'required')
            //->protectCaptcha(0)
            ->submit('Восстановить');

        $form->setError(
            [
                'login' => [
                    'required' => 'Введите логин или электронную почту',
                ]
            ]
        );

        if ($form->check()) {

            $result = Recovery::make()
                ->setLogin($form->get('login'))
                ->send(
                    'Восстановление пароля',
                    Engine::dir()->views . 'auth/email/recovery.php'
                );

            if (!$result) {
                $form->addError('Вы указали неверные данные');
            }
        }

        $data = [
            'form' => $form
        ];
        return $this->view('auth/recovery', $data);
    }

}