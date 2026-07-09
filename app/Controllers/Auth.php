<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\UserRoleModel;

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
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', (string) $this->request->getPost('email'))->first();

        if (! is_array($user) || ! password_verify((string) $this->request->getPost('password'), (string) ($user['password_hash'] ?? ''))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'The provided credentials do not match our records.');
        }

        if (($user['status'] ?? 'inactive') !== 'active') {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'This account is inactive and cannot log in yet.');
        }

        $role = $this->findUserRoleName((int) $user['id']);

        $this->session->set([
            'user_id' => (int) $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'role' => $role,
        ]);

        $userModel->update((int) $user['id'], ['last_login_at' => date('Y-m-d H:i:s')]);
        $this->recordAudit('login', 'user', (int) $user['id'], 'User logged into the repository.');

        return redirect()
            ->to($role === 'admin' ? '/admin' : '/dashboard')
            ->with('info', 'Welcome back, ' . $user['name'] . '.');
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
        $rules = [
            'name' => 'required|min_length[3]|max_length[150]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
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

    private function findUserRoleName(int $userId): string
    {
        $roleRow = model(UserRoleModel::class)
            ->select('roles.name')
            ->join('roles', 'roles.id = user_roles.role_id')
            ->where('user_roles.user_id', $userId)
            ->first();

        return is_array($roleRow) ? (string) ($roleRow['name'] ?? 'user') : 'user';
    }
}
