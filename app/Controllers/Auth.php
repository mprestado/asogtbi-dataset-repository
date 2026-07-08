<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login(): string
    {
        return view('auth/login', [
            'title' => 'Login',
        ]);
    }

    public function attemptLogin()
    {
        return redirect()
            ->to('/login')
            ->with('info', 'Login logic is ready to implement in task.');
    }

    public function register(): string
    {
        return view('auth/register', [
            'title' => 'Register',
        ]);
    }

    public function attemptRegister()
    {
        return redirect()
            ->to('/register')
            ->with('info', 'Registration logic is ready to implement in task.');
    }

    public function logout()
    {
        $this->session->destroy();

        return redirect()->to('/login');
    }
}
