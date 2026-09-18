<?php

require_once __DIR__ . '/../Models/Dosen.php';

class DosenController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new Dosen($pdo);
    }

    // MENAMPILKAN DAFTAR DOSEN
    public function index()
    {
        $dosen = $this->model->getAll();

        require_once __DIR__ . '/../Views/dosen/index.php';
    }

    // MENAMPILKAN FORM TAMBAH
    public function create()
    {
        require_once __DIR__ . '/../Views/dosen/create.php';
    }

    // MENYIMPAN DOSEN BARU
    public function store()
    {
        $data = [
            'nidn' => trim($_POST['nidn'] ?? ''),
            'nama' => trim($_POST['nama'] ?? ''),
            'bidang_keahlian' => trim($_POST['bidang_keahlian'] ?? '')
        ];

        // Validasi
        if (
            $data['nidn'] === '' ||
            $data['nama'] === '' ||
            $data['bidang_keahlian'] === ''
        ) {
            echo "Semua data wajib diisi.";
            exit;
        }

        // Simpan ke database
        $berhasil = $this->model->create($data);

        if ($berhasil) {
            header('Location: /si-akademik/public/dosen');
            exit;
        }

        echo "Gagal menyimpan data dosen.";
    }

        // FORM EDIT
        public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID dosen tidak ditemukan.";
            exit;
        }

        $dosen = $this->model->getById($id);

        if (!$dosen) {
            echo "Data dosen tidak ditemukan.";
            exit;
        }

        require_once __DIR__ . '/../Views/dosen/edit.php';
    }

        // UPDATE DOSEN
        public function update()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID dosen tidak ditemukan.";
            exit;
        }

        $this->model->update($id, [
            'nidn' => $_POST['nidn'],
            'nama' => $_POST['nama'],
            'bidang_keahlian' => $_POST['bidang_keahlian']
        ]);

        header('Location: /si-akademik/public/dosen');
        exit;
    }

        // HAPUS DOSEN
        public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID dosen tidak ditemukan.";
            exit;
        }

        $this->model->delete($id);

        header('Location: /si-akademik/public/dosen');
        exit;
    }
}