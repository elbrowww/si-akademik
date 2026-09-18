<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Dosen - Politeknik Negeri Jember</title>

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

            <h2 class="mb-4">Tambah Dosen</h2>

            <form
                method="POST"
                action="/si-akademik/public/dosen/store"
            >

                <div class="mb-3">
                    <label for="nidn" class="form-label">
                        NIDN
                    </label>

                    <input
                        type="text"
                        id="nidn"
                        name="nidn"
                        class="form-control"
                        placeholder="Masukkan NIDN"
                        required
                    >
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
                        placeholder="Masukkan nama dosen"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="bidang_keahlian" class="form-label">
                        Bidang Keahlian
                    </label>

                    <input
                        type="text"
                        id="bidang_keahlian"
                        name="bidang_keahlian"
                        class="form-control"
                        placeholder="Masukkan bidang keahlian"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Simpan
                </button>

                <a
                    href="/si-akademik/public/dosen"
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