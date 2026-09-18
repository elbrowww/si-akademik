<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h1 class="text-center mb-4">Politeknik Negeri Jember</h1>

        <div class="card shadow">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="card-title mb-0">Data Dosen</h2>
                    <a href="/si-akademik/public/mahasiswa" class="btn btn-primary">
                        Data Mahasiswa
                    </a>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Bidang Keahlian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($dosen as $index => $dsn): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($dsn['nidn']) ?></td>
                                <td><?= htmlspecialchars($dsn['nama']) ?></td>
                                <td><?= htmlspecialchars($dsn['bidang_keahlian']) ?></td>
                                <td>
                                    <a href="/si-akademik/public/dosen/detail?nidn=<?= $dsn['nidn']; ?>"
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
                    <a href="/si-akademik/public/dashboard" class="btn btn-secondary">
                        Dashboard
                    </a>
                </div>

            </div>
        </div>

    </div>

</body>

</html>