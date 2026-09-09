<?php

class AuthController
{
    // Halaman Login
    public function login()
    {
        // Jika sudah login, langsung ke dashboard
        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            header('Location: /si-akademik/public/dashboard');
            exit;
        }

        $error = $_SESSION['login_error'] ?? null;

        // Hapus pesan error setelah ditampilkan
        unset($_SESSION['login_error']);

        require_once __DIR__ . '/../Views/auth/login.php';
    }


    // Proses Login
    public function processLogin()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Akun sederhana sesuai tugas
        if ($username === 'admin' && $password === '12345') {

            $_SESSION['login'] = true;
            $_SESSION['username'] = 'admin';

            header('Location: /si-akademik/public/dashboard');
            exit;

        } else {

            $_SESSION['login_error'] = 'Username atau password salah.';

            header('Location: /si-akademik/public/login');
            exit;
        }
    }


    // Dashboard
    public function dashboard()
    {
        require_once __DIR__ . '/../Views/dashboard/index.php';
    }


    // Logout
    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: /si-akademik/public/login');
        exit;
    }
}