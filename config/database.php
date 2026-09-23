<?php

class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    //Mengembalikan koneksi PDO. Koneksi hanya dibuat sekali (lazy),lalu dipakai ulang selama request berjalan.
    public function getConnection()
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }
}

$host = 'localhost';
$dbname = 'si_akademik';
$username = 'root';
$password = '';

// Satu objek Database yang bisa di-inject ke class lain (mis. MahasiswaRepository).
$database = new Database($host, $dbname, $username, $password);

// Tetap sediakan $pdo mentah untuk Controller lain (Dosen, Auth) yang
$pdo = $database->getConnection();
