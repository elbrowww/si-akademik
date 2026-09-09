<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h1 class="text-center mb-4">Politeknik Negeri Jember</h1>

        <div class="card shadow">

            <div class="card-body">

                <h2 class="card-title mb-4">Detail Mahasiswa</h2>

                <table class="table table-bordered">

                    <tr>
                        <th width="200">NIM</th>
                        <td><?= $mahasiswa['nim'] ?></td>
                    </tr>

                    <tr>
                        <th>Nama</th>
                        <td><?= $mahasiswa['nama'] ?></td>
                    </tr>

                    <tr>
                        <th>Program Studi</th>
                        <td><?= $mahasiswa['prodi'] ?></td>
                    </tr>

                </table>

                <a href="/si-akademik/public/dosen" class="btn btn-secondary">
                    Kembali
                </a>

            </div>

        </div>

    </div>

</body>

</html>