<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Sistem Akademik</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- CSS Custom -->
    <link
        rel="stylesheet"
        href="/si-akademik/public/css/style.css"
    >

</head>

<body>

<div class="container">

    <div class="dashboard-container">

        <div class="card shadow dashboard-card">

            <div class="card-body">

                <h1 class="text-center mb-3">
                    Dashboard
                </h1>

                <p class="text-center">
                    Selamat datang,
                    <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>!
                </p>


                <hr>


                <div class="d-flex justify-content-center gap-2 flex-wrap">

                    <a
                        href="/si-akademik/public/mahasiswa"
                        class="btn btn-primary"
                    >
                        Data Mahasiswa
                    </a>


                    <a
                        href="/si-akademik/public/dosen"
                        class="btn btn-success"
                    >
                        Data Dosen
                    </a>


                    <a
                        href="/si-akademik/public/logout"
                        class="btn btn-danger"
                    >
                        Logout
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>