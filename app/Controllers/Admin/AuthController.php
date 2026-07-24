<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;

final class AuthController extends Controller
{
    public function loginForm(): void
    {
        if (Auth::check()) {
            redirect(admin_url('dashboard'));
        }
        $this->render('admin/login', ['errorMessage' => flash('error')], 'admin/layouts/guest');
    }

    public function login(): void
    {
        Csrf::requireValid();
        if (Auth::check()) {
            redirect(admin_url('dashboard'));
        }

        $login = trim((string) ($_POST['login'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        if ($login === '' || $password === '') {
            flash('error', 'Enter your username or email and password.');
            redirect(admin_url('login'));
        }

        $result = Auth::attempt($login, $password);
        if (!$result['success']) {
            flash('error', $result['message']);
            redirect(admin_url('login'));
        }

        flash('success', 'Welcome back.');
        redirect(admin_url('dashboard'));
    }

    public function logout(): void
    {
        Auth::requireLogin();
        Csrf::requireValid();
        Auth::logout();
        redirect(admin_url('login'));
    }
}
