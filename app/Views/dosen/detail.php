<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dosen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h1 class="text-center mb-4">Politeknik Negeri Jember</h1>

        <div class="card shadow">

            <div class="card-body">

                <h2 class="card-title mb-4">Detail Dosen</h2>

                <table class="table table-bordered">

                    <tr>
                        <th width="200">NIDN</th>
                        <td><?= $dosen['nidn'] ?></td>
                    </tr>

                    <tr>
                        <th>Nama</th>
                        <td><?= $dosen['nama'] ?></td>
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