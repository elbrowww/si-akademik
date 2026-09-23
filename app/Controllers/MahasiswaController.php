<?php

require_once __DIR__ . '/../Models/Mahasiswa.php';
require_once __DIR__ . '/../Repositories/MahasiswaRepository.php';

class MahasiswaController
{
    private $repository;

    // Constructor Injection: controller menerima MahasiswaRepository,
    // sehingga controller tidak lagi membuat koneksi database sendiri.
    public function __construct(MahasiswaRepository $repository)
    {
        $this->repository = $repository;
    }

    // MENAMPILKAN DAFTAR MAHASISWA
    public function index()
    {
        $mahasiswa = $this->repository->getAll();

        require_once __DIR__ . '/../Views/mahasiswa/index.php';
    }

    // MENAMPILKAN DETAIL MAHASISWA
    public function detail()
    {
        $nim = $_GET['nim'] ?? null;

        if (!$nim) {
            header('Location: /si-akademik/public/mahasiswa');
            exit;
        }

        $mahasiswa = $this->repository->getByNim($nim);

        if (!$mahasiswa) {
            echo "Data mahasiswa tidak ditemukan.";
            exit;
        }

        require_once __DIR__ . '/../Views/mahasiswa/detail.php';
    }


    // ROUTING DINAMIS
    // /mahasiswa/5
    public function show($id)
    {
        echo "
        <!DOCTYPE html>
        <html lang='id'>

        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>

            <title>Routing Dinamis</title>

            <link
                href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
                rel='stylesheet'
            >
        </head>

        <body>

            <div class='container mt-5'>

                <div class='card shadow'>

                    <div class='card-body text-center'>

                        <h1 class='mb-3'>
                            Routing Dinamis Berhasil
                        </h1>

                        <p class='lead'>
                            ID Mahasiswa yang diterima:
                        </p>

                        <h2 class='text-primary mb-4'>
                            $id
                        </h2>

                        <p class='text-muted'>
                            Method <strong>show()</strong> berhasil
                            menerima parameter ID dari URL.
                        </p>

                        <a
                            href='/si-akademik/public/mahasiswa'
                            class='btn btn-secondary'
                        >
                            Kembali ke Mahasiswa
                        </a>

                    </div>

                </div>

            </div>

        </body>

        </html>
        ";
    }



    // FORM GET
    public function search()
    {
        $nim = $_GET['nim'] ?? '';

        echo "
        <!DOCTYPE html>
        <html lang='id'>

        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>

            <title>Pencarian Mahasiswa</title>

            <link
                href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
                rel='stylesheet'
            >
        </head>

        <body>

            <div class='container mt-5'>

                <div class='card shadow'>

                    <div class='card-body'>

                        <h2 class='mb-4'>
                            Pencarian Mahasiswa
                        </h2>

                        <form
                            method='GET'
                            action='/si-akademik/public/mahasiswa/search'
                        >

                            <div class='mb-3'>

                                <label class='form-label'>
                                    NIM
                                </label>

                                <input
                                    type='text'
                                    name='nim'
                                    class='form-control'
                                    placeholder='Masukkan NIM'
                                    value='$nim'
                                >

                            </div>

                            <button
                                type='submit'
                                class='btn btn-primary'
                            >
                                Cari
                            </button>

                            <a
                                href='/si-akademik/public/mahasiswa'
                                class='btn btn-secondary'
                            >
                                Kembali
                            </a>

                        </form>
        ";

        if ($nim !== '') {

            echo "
                            <div class='alert alert-info mt-4'>

                                NIM yang diterima melalui GET:

                                <strong>
                                    $nim
                                </strong>

                            </div>
            ";
        }

        echo "
                    </div>

                </div>

            </div>

        </body>

        </html>
        ";
    }


    // FORM TAMBAH MAHASISWA
    public function create()
    {
        $errors = $_SESSION['form_errors'] ?? [];
        unset($_SESSION['form_errors']);

        require_once __DIR__ . '/../Views/mahasiswa/create.php';
    }


    // MEMPROSES FORM POST (validasi dilakukan lewat setter di entity Mahasiswa)
    public function store()
    {
        try {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->setNim($_POST['nim'] ?? '');
            $mahasiswa->setNama($_POST['nama'] ?? '');
            $mahasiswa->setProdi($_POST['prodi'] ?? '');
            $mahasiswa->setDosenId($_POST['dosen_id'] ?? '');

            $this->repository->create($mahasiswa);

            // SESSION
            $_SESSION['nim_mahasiswa'] = $mahasiswa->getNim();
            $_SESSION['nama_mahasiswa'] = $mahasiswa->getNama();
            $_SESSION['prodi_mahasiswa'] = $mahasiswa->getProdi();

            // COOKIE
            setcookie(
                'nama_pengunjung',
                $mahasiswa->getNama(),
                time() + 3600,
                '/'
            );

            header('Location: /si-akademik/public/mahasiswa');
            exit;
        } catch (InvalidArgumentException $e) {
            $_SESSION['form_errors'] = [$e->getMessage()];
            header('Location: /si-akademik/public/mahasiswa/create');
            exit;
        }
    }


    // FORM EDIT MAHASISWA
    public function edit()
    {
        $nim = $_GET['nim'] ?? null;

        if (!$nim) {
            echo "NIM mahasiswa tidak ditemukan.";
            exit;
        }

        $mahasiswa = $this->repository->getByNim($nim);

        if (!$mahasiswa) {
            echo "Data mahasiswa tidak ditemukan.";
            exit;
        }

        $errors = $_SESSION['form_errors'] ?? [];
        unset($_SESSION['form_errors']);

        require_once __DIR__ . '/../Views/mahasiswa/edit.php';
    }


    // MEMPROSES UPDATE MAHASISWA
    public function update()
    {
        $nim = $_GET['nim'] ?? null;

        if (!$nim) {
            echo "NIM mahasiswa tidak ditemukan.";
            exit;
        }

        try {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->setNim($nim);
            $mahasiswa->setNama($_POST['nama'] ?? '');
            $mahasiswa->setProdi($_POST['prodi'] ?? '');
            $mahasiswa->setDosenId($_POST['dosen_id'] ?? '');

            $this->repository->update($nim, $mahasiswa);

            header('Location: /si-akademik/public/mahasiswa');
            exit;
        } catch (InvalidArgumentException $e) {
            $_SESSION['form_errors'] = [$e->getMessage()];
            header('Location: /si-akademik/public/mahasiswa/edit?nim=' . urlencode($nim));
            exit;
        }
    }


    // MENGHAPUS MAHASISWA
    public function delete()
    {
        $nim = $_GET['nim'] ?? null;

        if (!$nim) {
            echo "NIM mahasiswa tidak ditemukan.";
            exit;
        }

        $this->repository->delete($nim);

        header('Location: /si-akademik/public/mahasiswa');
        exit;
    }

    // MENAMPILKAN SESSIO
    public function sessionDemo()
    {
        $nim = $_SESSION['nim_mahasiswa'] ?? 'Belum ada';
        $nama = $_SESSION['nama_mahasiswa'] ?? 'Belum ada';
        $prodi = $_SESSION['prodi_mahasiswa'] ?? 'Belum ada';

        echo "
        <!DOCTYPE html>
        <html lang='id'>

        <head>

            <meta charset='UTF-8'>

            <meta
                name='viewport'
                content='width=device-width, initial-scale=1.0'
            >

            <title>Session</title>

            <link
                href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
                rel='stylesheet'
            >

        </head>

        <body>

            <div class='container mt-5'>

                <div class='card shadow'>

                    <div class='card-body'>

                        <h2 class='text-primary mb-4'>
                            Data Session
                        </h2>

                        <div class='alert alert-success'>

                            Data mahasiswa berhasil diambil
                            dari <strong>Session</strong>.

                        </div>

                        <table class='table table-bordered'>

                            <tr>
                                <th>NIM</th>
                                <td>$nim</td>
                            </tr>

                            <tr>
                                <th>Nama</th>
                                <td>$nama</td>
                            </tr>

                            <tr>
                                <th>Program Studi</th>
                                <td>$prodi</td>
                            </tr>

                        </table>

                        <a
                            href='/si-akademik/public/mahasiswa'
                            class='btn btn-secondary'
                        >
                            Kembali ke Mahasiswa
                        </a>

                    </div>

                </div>

            </div>

        </body>

        </html>
        ";
    }

    // MENAMPILKAN COOKI
    public function cookieDemo()
    {
        $nama = $_COOKIE['nama_pengunjung'] ?? 'Belum ada';

        echo "
        <!DOCTYPE html>
        <html lang='id'>

        <head>

            <meta charset='UTF-8'>

            <meta
                name='viewport'
                content='width=device-width, initial-scale=1.0'
            >

            <title>Cookie</title>

            <link
                href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
                rel='stylesheet'
            >

        </head>

        <body>

            <div class='container mt-5'>

                <div class='card shadow'>

                    <div class='card-body'>

                        <h2 class='text-primary mb-4'>
                            Data Cookie
                        </h2>

                        <div class='alert alert-success'>

                            Data berhasil diambil dari
                            <strong>Cookie</strong>.

                        </div>

                        <p class='fs-5'>

                            Nama pengunjung:

                            <strong>
                                $nama
                            </strong>

                        </p>

                        <p class='text-muted'>
                            Cookie berlaku selama 1 jam.
                        </p>

                        <a
                            href='/si-akademik/public/mahasiswa'
                            class='btn btn-secondary'
                        >
                            Kembali ke Mahasiswa
                        </a>

                    </div>

                </div>

            </div>

        </body>

        </html>
        ";
    }
}
