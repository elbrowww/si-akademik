<?php

class AuthMiddleware
{
    public static function handle()
    {
        // Cek apakah user sudah login
        if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {

            header('Location: /si-akademik/public/login');
            exit;
        }
    }
}
