<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\PasswordResetModel;
use App\Models\UserModel;
use App\Models\UserRoleModel;

class Auth extends BaseController
{
    public function login(): string
    {
        return view('auth/login', [
            'title' => 'Sign in',
            'validation' => session()->getFlashdata('validation'),
            'demoAccounts' => [
                ['role' => 'User', 'email' => 'user@example.test', 'password' => 'change-me'],
                ['role' => 'Repository Administrator', 'email' => 'admin@example.test', 'password' => 'change-me'],
                ['role' => 'Research Ethics Reviewer', 'email' => 'ethics@example.test', 'password' => 'change-me'],
                ['role' => 'Technical Reviewer', 'email' => 'technical@example.test', 'password' => 'change-me'],
            ],
            'loginChecks' => [
                'Email and password authentication for MVP-FR-01 and MVP-FR-02.',
                'Seeded demo accounts exist for local walkthroughs after migrations and seeding.',
                'Inactive accounts are blocked before a session is created.',
            ],
        ]);
    }

    public function attemptLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('validation', $this->validator->getErrors())
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', (string) $this->request->getPost('email'))->first();

        if (! is_array($user) || ! password_verify((string) $this->request->getPost('password'), (string) ($user['password_hash'] ?? ''))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('validation', ['email' => 'Check your email and password, then try again.'])
                ->with('error', 'The provided credentials do not match our records.');
        }

        if (($user['status'] ?? 'inactive') !== 'active') {
            return redirect()
                ->back()
                ->withInput()
                ->with('validation', ['email' => 'This account is inactive. Contact a repository administrator for access.'])
                ->with('error', 'This account is inactive and cannot log in yet.');
        }

        $roles = $this->findUserRoleNames((int) $user['id']);

        $this->session->set([
            'user_id' => (int) $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'role' => $roles[0] ?? 'user',
            'roles' => $roles,
        ]);

        $userModel->update((int) $user['id'], ['last_login_at' => date('Y-m-d H:i:s')]);
        $this->recordAudit('login', 'user', (int) $user['id'], 'User logged into the repository.');

        return redirect()
            ->to($this->postLoginDestination($roles))
            ->with('info', 'Welcome back, ' . $user['name'] . '.');
    }

    public function register(): string
    {
        return view('auth/register', [
            'title' => 'Sign up',
            'validation' => session()->getFlashdata('validation'),
            'requiredFields' => ['Name', 'Email', 'Password'],
            'registerNotes' => [
                'The user-facing MVP supports self-registration for contributors.',
                'Passwords must remain hashed before persistence.',
                'New accounts receive the User role for browsing, citation, download, upload, update, and archive flows.',
            ],
        ]);
    }

    public function forgotPassword(): string
    {
        return view('auth/forgot_password', [
            'title' => 'Forgot Password',
        ]);
    }

    public function sendResetLink()
    {
        $rules = [
            'email' => 'required|valid_email',
        ];

        if (! $this->validate($rules)) {
            $token = rawurlencode((string) $this->request->getPost('token'));
            $email = rawurlencode((string) $this->request->getPost('email'));

            return redirect()
                ->to('/reset-password?token=' . $token . '&email=' . $email)
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $email = trim((string) $this->request->getPost('email'));
        $user = model(UserModel::class)->where('email', $email)->first();

        if (is_array($user) && ($user['status'] ?? 'inactive') === 'active') {
            $token = bin2hex(random_bytes(32));
            $tokenHash = hash('sha256', $token);

            model(PasswordResetModel::class)->insert([
                'email' => $email,
                'token_hash' => $tokenHash,
                'expires_at' => date('Y-m-d H:i:s', strtotime('+30 minutes')),
            ]);

            if (ENVIRONMENT === 'development') {
                $this->session->setFlashdata('reset_link', site_url('reset-password?token=' . $token . '&email=' . rawurlencode($email)));
            }
        }

        return redirect()
            ->to('/forgot-password')
            ->with('info', 'If that active account exists, a password reset link has been prepared.');
    }

    public function resetPassword(): string
    {
        $token = trim((string) $this->request->getGet('token'));
        $email = trim((string) $this->request->getGet('email'));

        if ($token === '' || $email === '' || ! $this->isValidPasswordResetToken($email, $token)) {
            return view('auth/reset_password', [
                'title' => 'Reset Password',
                'token' => '',
                'email' => '',
                'isValidToken' => false,
            ]);
        }

        return view('auth/reset_password', [
            'title' => 'Reset Password',
            'token' => $token,
            'email' => $email,
            'isValidToken' => true,
        ]);
    }

    public function updatePassword()
    {
        $rules = [
            'email' => 'required|valid_email',
            'token' => 'required',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $email = trim((string) $this->request->getPost('email'));
        $token = trim((string) $this->request->getPost('token'));
        $reset = $this->findValidPasswordReset($email, $token);

        if (! is_array($reset)) {
            return redirect()
                ->to('/forgot-password')
                ->with('error', 'That password reset link is invalid or expired.');
        }

        $user = model(UserModel::class)->where('email', $email)->first();
        if (! is_array($user)) {
            return redirect()
                ->to('/forgot-password')
                ->with('error', 'That password reset link is invalid or expired.');
        }

        model(UserModel::class)->update((int) $user['id'], [
            'password_hash' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);
        model(PasswordResetModel::class)->update((int) $reset['id'], [
            'used_at' => date('Y-m-d H:i:s'),
        ]);
        $this->recordAudit('password_reset', 'user', (int) $user['id'], 'User password was reset.');

        return redirect()
            ->to('/login')
            ->with('info', 'Password updated. You can now log in.');
    }

    public function attemptRegister()
    {
        $rules = [
            'name' => [
                'label' => 'Full name',
                'rules' => 'required|min_length[3]|max_length[150]',
            ],
            'email' => [
                'label' => 'CSPC email',
                'rules' => 'required|valid_email|regex_match[/^[^@\s]+@cspc\.edu\.ph$/i]|is_unique[users.email]',
                'errors' => [
                    'regex_match' => 'Use your official CSPC email address ending in @cspc.edu.ph.',
                    'is_unique' => 'This email is already registered. Try logging in instead.',
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('validation', $this->validator->getErrors())
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $userModel = new UserModel();
        $roleModel = new RoleModel();
        $userRoleModel = new UserRoleModel();

        $userId = (int) $userModel->insert([
            'name' => trim((string) $this->request->getPost('name')),
            'email' => trim((string) $this->request->getPost('email')),
            'password_hash' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'status' => 'active',
        ], true);

        $role = $roleModel->where('name', 'user')->first();
        if (! is_array($role)) {
            $roleId = (int) $roleModel->insert([
                'name' => 'user',
                'description' => 'Authorized dataset user',
            ], true);
        } else {
            $roleId = (int) $role['id'];
        }

        $userRoleModel->insert([
            'user_id' => $userId,
            'role_id' => $roleId,
        ]);

        $this->recordAudit('register', 'user', $userId, 'New user account created through registration.');

        return redirect()
            ->to('/login')
            ->with('info', 'Account created successfully. You can now log in.');
    }

    public function logout()
    {
        $userId = $this->currentUserId();
        if ($userId !== null) {
            $this->recordAudit('logout', 'user', $userId, 'User logged out of the repository.');
        }

        $this->session->destroy();

        return redirect()->to('/login');
    }

    private function findUserRoleNames(int $userId): array
    {
        $roleRows = model(UserRoleModel::class)
            ->select('roles.name')
            ->join('roles', 'roles.id = user_roles.role_id')
            ->where('user_roles.user_id', $userId)
            ->orderBy('roles.name', 'ASC')
            ->findAll();

        $roles = array_values(array_filter(array_map(static fn (array $row): string => (string) ($row['name'] ?? ''), $roleRows)));

        return $roles !== [] ? $roles : ['user'];
    }

    /**
     * Maintainer accounts should land in their work queue instead of the public contributor dashboard.
     *
     * @param array<int, string> $roles
     */
    private function postLoginDestination(array $roles): string
    {
        if (in_array('repository_administrator', $roles, true)) {
            return '/admin';
        }
        if (in_array('technical_reviewer', $roles, true)) {
            return '/review/technical';
        }
        if (in_array('ethics_reviewer', $roles, true)) {
            return '/review/ethics';
        }

        return '/dashboard';
    }

    private function isValidPasswordResetToken(string $email, string $token): bool
    {
        return is_array($this->findValidPasswordReset($email, $token));
    }

    /**
     * @return array<string, mixed>|null
     */
    private function findValidPasswordReset(string $email, string $token): ?array
    {
        $tokenHash = hash('sha256', $token);
        $reset = model(PasswordResetModel::class)
            ->where('email', $email)
            ->where('token_hash', $tokenHash)
            ->where('used_at', null)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->orderBy('created_at', 'DESC')
            ->first();

        return is_array($reset) ? $reset : null;
    }
}
