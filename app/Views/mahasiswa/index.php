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
                        <div>
                            <a href="/si-akademik/public/mahasiswa/create" class="btn btn-success">
                                + Tambah Mahasiswa
                            </a>
                            <a href="/si-akademik/public/dosen" class="btn btn-primary">
                                Data Dosen
                            </a>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Dosen Pembimbing</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($mahasiswa)): ?>
                                <?php foreach ($mahasiswa as $mhs): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($mhs->getNim()) ?></td>
                                        <td><?= htmlspecialchars($mhs->getNama()) ?></td>
                                        <td><?= htmlspecialchars($mhs->getProdi()) ?></td>
                                        <td><?= htmlspecialchars($mhs->getNamaDosen() ?? 'Belum ada') ?></td>
                                        <td>

                                            <a href="/si-akademik/public/mahasiswa/edit?nim=<?= urlencode($mhs->getNim()); ?>"
                                            class="btn btn-warning btn-sm">
                                                Edit
                                            </a>

                                            <a href="/si-akademik/public/mahasiswa/delete?nim=<?= urlencode($mhs->getNim()); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus data ini?');">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data mahasiswa.</td>
                                </tr>
                            <?php endif; ?>
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
