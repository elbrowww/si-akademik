<?php

require_once __DIR__ . '/../Models/Mahasiswa.php';

class MahasiswaController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // MENAMPILKAN DAFTAR MAHASISWA
    public function index()
    {
        $model = new Mahasiswa($this->pdo);
        $mahasiswa = $model->getAll();

        require_once __DIR__ . '/../Views/mahasiswa/index.php';
    }

    // MENAMPILKAN DETAIL MAHASISWA
    public function detail()
    {
        $model = new Mahasiswa($this->pdo);

        $nim = $_GET['nim'] ?? null;

        if (!$nim) {
            header('Location: /si-akademik/public/mahasiswa');
            exit;
        }

        $mahasiswa = $model->getByNim($nim);

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
        echo "
        <!DOCTYPE html>
        <html lang='id'>

        <head>

            <meta charset='UTF-8'>

            <meta
                name='viewport'
                content='width=device-width, initial-scale=1.0'
            >

            <title>Tambah Mahasiswa</title>

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
                            Tambah Mahasiswa
                        </h2>

                        <form
                            method='POST'
                            action='/si-akademik/public/mahasiswa'
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
                                >

                            </div>

                            <div class='mb-3'>

                                <label class='form-label'>
                                    Nama
                                </label>

                                <input
                                    type='text'
                                    name='nama'
                                    class='form-control'
                                    placeholder='Masukkan Nama'
                                >

                            </div>

                            <div class='mb-3'>

                                <label class='form-label'>
                                    Program Studi
                                </label>

                                <input
                                    type='text'
                                    name='prodi'
                                    class='form-control'
                                    placeholder='Masukkan Program Studi'
                                >

                            </div>

                            <button
                                type='submit'
                                class='btn btn-primary'
                            >
                                Simpan
                            </button>

                            <a
                                href='/si-akademik/public/mahasiswa'
                                class='btn btn-secondary'
                            >
                                Kembali
                            </a>

                        </form>

                    </div>

                </div>

            </div>

        </body>

        </html>
        ";
    }


    // MEMPROSES FORM POST
    public function store()
    {
        $nim = trim($_POST['nim'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $prodi = trim($_POST['prodi'] ?? '');

        // VALIDASI INPUT
        $errors = [];

        if ($nim === '') {
            $errors[] = 'NIM wajib diisi.';
        }

        if ($nama === '') {
            $errors[] = 'Nama wajib diisi.';
        }

        if ($prodi === '') {
            $errors[] = 'Program Studi wajib diisi.';
        }


        // JIKA VALIDASI GAGAL
        if (!empty($errors)) {

            echo "
            <!DOCTYPE html>
            <html lang='id'>

            <head>

                <meta charset='UTF-8'>

                <meta
                    name='viewport'
                    content='width=device-width, initial-scale=1.0'
                >

                <title>Validasi Form</title>

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
                                Validasi Form
                            </h2>

                            <div class='alert alert-danger'>

                                <strong>
                                    Terdapat kesalahan:
                                </strong>

                                <ul class='mb-0 mt-2'>
            ";

            foreach ($errors as $error) {

                echo "
                                    <li>
                                        $error
                                    </li>
                ";
            }

            echo "
                                </ul>

                            </div>

                            <a
                                href='/si-akademik/public/mahasiswa/create'
                                class='btn btn-primary'
                            >
                                Kembali ke Form
                            </a>

                        </div>

                    </div>

                </div>

            </body>

            </html>
            ";

            return;
        }


        // SESSION
        $_SESSION['nim_mahasiswa'] = $nim;
        $_SESSION['nama_mahasiswa'] = $nama;
        $_SESSION['prodi_mahasiswa'] = $prodi;


        // COOKIE
        setcookie(
            'nama_pengunjung',
            $nama,
            time() + 3600,
            '/'
        );


        // HASIL POST
        echo "
        <!DOCTYPE html>
        <html lang='id'>

        <head>

            <meta charset='UTF-8'>

            <meta
                name='viewport'
                content='width=device-width, initial-scale=1.0'
            >

            <title>Data Berhasil</title>

            <link
                href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
                rel='stylesheet'
            >

        </head>

        <body>

            <div class='container mt-5'>

                <div class='card shadow'>

                    <div class='card-body'>

                        <h2 class='text-success mb-4'>
                            Form Berhasil Dikirim
                        </h2>

                        <div class='alert alert-success'>

                            Data berhasil diterima menggunakan
                            <strong>POST</strong>.

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

                        <div class='alert alert-primary mt-4'>

                            <strong>Session:</strong><br>

                            Data mahasiswa berhasil disimpan
                            ke dalam Session.

                        </div>

                        <div class='alert alert-warning'>

                            <strong>Cookie:</strong><br>

                            Cookie nama pengunjung berhasil dibuat
                            dan berlaku selama 1 jam.

                        </div>

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