<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>IKS | Daftar</title>
</head>

<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <div class="col-12 col-md-8 col-lg-6 col-xl-4">
            <div class="card " style="border-radius: 1rem">
                <div class="card-body p-5 ">
                    <div class="mb-md-3 mt-md-4">
                        <h2 class="fw-bold mb-4 text-uppercase text-center">Daftar</h2>
                        <form class="form" action="<?= base_url('/signup') ?>" method="post">
                            <?= csrf_field(); ?>

                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <input
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    type="text"
                                    placeholder="Email"
                                    value="<?= set_value('email') ?>" />
                                <span class="text-danger text-sm d-block ml-1"><?= session('errors.email') ?? '' ?></span>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4 text-left">
                                <input
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    type="text"
                                    placeholder="Username"
                                    value="<?= set_value('username') ?>" />
                                <span class="text-danger text-sm d-block ml-1"><?= session('errors.username') ?? '' ?></span>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <input
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="Password"
                                    value="<?= set_value('password') ?>" />
                                <span class="text-danger text-sm d-block ml-1"><?= session('errors.password') ?? '' ?></span>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <input
                                    class="form-control"
                                    id="confirmPassword"
                                    name="confirmPassword"
                                    type="password"
                                    placeholder="Confirm Password"
                                    value="<?= set_value('confirmPassword') ?>" />
                                <span class="text-danger text-sm d-block ml-1"><?= session('errors.confirmPassword') ?? '' ?></span>
                            </div>

                            <button
                                data-mdb-button-init
                                data-mdb-ripple-init
                                class="btn px-5 text-white d-block mx-auto"
                                style="background-color: #36bc6a; transition: all 0.2s ease-in-out;"
                                onmouseover="this.style.backgroundColor='#3e8e41';"
                                onmouseout="this.style.backgroundColor='#36bc6a';"
                                type="submit">
                                Daftar
                            </button>
                        </form>
                    </div>

                    <div>
                        <p class="mb-0 text-center">
                            Sudah punya akun?
                            <a href="/signin" class="fw-bold"
                                style="color: #36bc6a; transition: all 0.2s ease-in-out;"
                                onmouseover="this.style.color='#3e8e41';"
                                onmouseout="this.style.color='#36bc6a';">Masuk</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>