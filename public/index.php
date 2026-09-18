<?php

session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Base path project
$base = '/si-akademik/public';

if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

// ROUTING
if (isset($routes[$method][$uri])) {

    [$controllerName, $action] = $routes[$method][$uri];

    // Halaman yang harus login terlebih dahulu
    $protectedRoutes = [
        '/dashboard',
        '/mahasiswa',
        '/mahasiswa/detail',
        '/mahasiswa/search',
        '/mahasiswa/create',
        '/mahasiswa/session',
        '/mahasiswa/cookie',
    
        '/dosen',
        '/dosen/create',
        '/dosen/edit',
        '/dosen/delete'
    ];

    if (in_array($uri, $protectedRoutes)) {
        require_once __DIR__ . '/../app/Middleware/AuthMiddleware.php';
        AuthMiddleware::handle();
    }

    // CONTROLLER
    require_once __DIR__ . '/../app/Controllers/' . $controllerName . '.php';

    // KIRIM PDO KE CONTROLLER
    $controller = new $controllerName($pdo);

    $controller->$action();


// ROUTING DINAMIS: /mahasiswa/5
} elseif ($method === 'GET' && preg_match('#^/mahasiswa/([0-9]+)$#', $uri, $matches)) {

    // Middleware
    require_once __DIR__ . '/../app/Middleware/AuthMiddleware.php';
    AuthMiddleware::handle();

    require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';

    $controller = new MahasiswaController($pdo);

    $id = $matches[1];

    $controller->show($id);


// 404
} else {

    http_response_code(404);

    echo "404 - Halaman tidak ditemukan";
}