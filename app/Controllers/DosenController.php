<?php

require_once __DIR__ . '/../Models/dosen.php';

class DosenController
{
    public function index()
    {
        $model = new Dosen();
        $dosen = $model->getAll();

        require_once __DIR__ . '/../Views/dosen/index.php';
    }

    public function detail()
    {
        $model = new Dosen();
        $nidn = $_GET['nidn'] ?? null;
        $dosen = $model->getByNidn($nidn);

        require_once __DIR__ . '/../Views/dosen/detail.php';
    }
}