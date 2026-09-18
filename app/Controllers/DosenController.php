<?php

require_once __DIR__ . '/../Models/Dosen.php';

class DosenController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new Dosen($pdo);
    }

    public function index()
    {
        $dosen = $this->model->getAll();

        require_once __DIR__ . '/../Views/dosen/index.php';
    }
}