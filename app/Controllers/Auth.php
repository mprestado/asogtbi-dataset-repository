<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login(): string
    {
        return view('auth/login', [
            'title' => 'Login',
            'demoAccounts' => [
                ['role' => 'Admin', 'email' => 'admin@example.test', 'password' => 'change-me'],
                ['role' => 'User', 'email' => 'user@example.test', 'password' => 'change-me'],
            ],
            'loginChecks' => [
                'Email and password authentication for MVP-FR-01 and MVP-FR-02.',
                'Seeded demo accounts exist for local walkthroughs after migrations and seeding.',
                'Inactive-account blocking and route guards still need implementation work.',
            ],
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
            'requiredFields' => ['Name', 'Email', 'Password'],
            'registerNotes' => [
                'The MVP allows registration or administrator-created accounts.',
                'Passwords must remain hashed before persistence.',
                'Role assignment and activation should stay visible to administrators.',
            ],
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
