<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('user_id')) {
            return redirect()->to('/login')->with('error', 'Please log in to continue.');
        }

        $requiredRoles = $arguments ?? [];
        $currentRole = session()->get('role');

        if ($requiredRoles !== [] && ! in_array($currentRole, $requiredRoles, true)) {
            return redirect()->to('/dashboard')->with('error', 'You are not allowed to open that page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No after-response work needed for the MVP skeleton.
    }
}
