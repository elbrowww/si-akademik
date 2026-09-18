<?php

require_once __DIR__ . '/../app/Controllers/DosenController.php'; 
require_once __DIR__ . '/../app/Middleware/AuthMiddleware.php'; 



$routes = [

    'GET' => [

        // Halaman awal → Login
        '/' => ['AuthController', 'login'],

        // Login
        '/login' => ['AuthController', 'login'],

        // Logout
        '/logout' => ['AuthController', 'logout'],

        // Dashboard
        '/dashboard' => ['AuthController', 'dashboard'],

        // Mahasiswa
        '/mahasiswa' => ['MahasiswaController', 'index'],
        '/mahasiswa/detail' => ['MahasiswaController', 'detail'],
        '/mahasiswa/search' => ['MahasiswaController', 'search'],
        '/mahasiswa/create' => ['MahasiswaController', 'create'],
        '/mahasiswa/session' => ['MahasiswaController', 'sessionDemo'],
        '/mahasiswa/cookie' => ['MahasiswaController', 'cookieDemo'],

        // Dosen
        '/dosen' => ['DosenController', 'index'],
        

    ],

    'POST' => [

        // Proses Login
        '/login/process' => ['AuthController', 'processLogin'],

        // Simpan Mahasiswa
        '/mahasiswa' => ['MahasiswaController', 'store'],

    ],

];