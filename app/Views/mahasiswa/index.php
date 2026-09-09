    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Mahasiswa</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <div class="container mt-5">

            <h1 class="text-center mb-4">Politeknik Negeri Jember</h1>

            <div class="card shadow">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="card-title mb-0">Data Mahasiswa</h2>
                        <a href="/si-akademik/public/dosen" class="btn btn-primary">
                        Data Dosen
                        </a>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($mahasiswa as $mhs): ?>
                                <tr>
                                    <td><?= $mhs['nim'] ?></td>
                                    <td><?= $mhs['nama'] ?></td>
                                    <td><?= $mhs['prodi'] ?></td>
                                    <td>
                                        <a href="/si-akademik/public/mahasiswa/detail?nim=<?= $mhs['nim']; ?>"
                                            class="btn btn-primary btn-sm">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between mt-4">

                        <!-- Button Kembali -->
                        <a href="/si-akademik/public/" class="btn btn-secondary">
                            Kembali ke Beranda
                        </a>

                        

                    </div>


                </div>
            </div>
        </div>

    </body>

    </html>