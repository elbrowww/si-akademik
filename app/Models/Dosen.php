<?php

class Dosen
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query(
            "SELECT * FROM dosen ORDER BY nama ASC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}