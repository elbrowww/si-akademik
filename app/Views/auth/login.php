<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistem Akademik</title>

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

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="container col-md-4">

    <div class="login-container">

        <div class="login-card">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-1">
                        Login
                    </h2>

                    <p class="text-center text-muted">
                        Sistem Informasi Akademik
                    </p>


                    <?php if (!empty($error)): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error); ?>
                        </div>

                    <?php endif; ?>


                    <form
                        method="POST"
                        action="/si-akademik/public/login/process"
                    >

                        <div class="mb-1">

                            <label class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-1">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control mb-3"
                                required
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>