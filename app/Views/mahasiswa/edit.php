<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa - Politeknik Negeri Jember</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-4">

    <h1 class="text-center mb-4">
        Politeknik Negeri Jember
    </h1>

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">Edit Mahasiswa</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <strong>Terdapat kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form
                method="POST"
                action="/si-akademik/public/mahasiswa/update?nim=<?= urlencode($mahasiswa->getNim()); ?>"
            >

                <div class="mb-3">
                    <label class="form-label">
                        NIM
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($mahasiswa->getNim()); ?>"
                        disabled
                    >
                    <div class="form-text">NIM tidak dapat diubah.</div>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">
                        Nama
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        value="<?= htmlspecialchars($mahasiswa->getNama()); ?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="prodi" class="form-label">
                        Program Studi
                    </label>

                    <input
                        type="text"
                        id="prodi"
                        name="prodi"
                        class="form-control"
                        value="<?= htmlspecialchars($mahasiswa->getProdi()); ?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="dosen_id" class="form-label">
                        ID Dosen Pembimbing (opsional)
                    </label>

                    <input
                        type="text"
                        id="dosen_id"
                        name="dosen_id"
                        class="form-control"
                        value="<?= htmlspecialchars($mahasiswa->getDosenId() ?? '') ?>"
                        placeholder="Kosongkan jika belum ada"
                    >
                </div>

                <button
                    type="submit"
                    class="btn btn-warning"
                >
                    Update
                </button>

                <a
                    href="/si-akademik/public/mahasiswa"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>
