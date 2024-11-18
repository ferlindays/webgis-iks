<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>IKS | Login</title>
</head>

<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <div class="col-12 col-md-8 col-lg-6 col-xl-4">
            <div class="card " style="border-radius: 1rem">
                <div class="card-body p-5 ">
                    <div class="mb-md-3 mt-md-4">
                        <h2 class="fw-bold mb-4 text-uppercase text-center">Login Admin</h2>
                        <?php if (session('success.message')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session('success.message') ?>
                            </div>
                        <?php endif ?>
                        <?php if (session('errors.message')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('errors.message') ?>
                            </div>
                        <?php endif ?>
                        <form class="form" action="<?= base_url('/signin') ?>" method="post">
                            <?= csrf_field(); ?>

                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <input
                                    class="form-control"
                                    type="text"
                                    id="identity"
                                    name="identity"
                                    placeholder="Username / Email"
                                    value="<?= set_value('identity') ?>" />
                                <span class="text-danger text-sm d-block ml-1"><?= session('errors.identity') ?? '' ?></span>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <input
                                    class="form-control"
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Password" />
                                <span class="text-danger text-sm d-block ml-1"><?= session('errors.password') ?? '' ?></span>
                            </div>

                            <button
                                data-mdb-button-init
                                data-mdb-ripple-init
                                class="btn px-5 text-white d-block mx-auto"
                                style="background-color: #36bc6a; transition: all 0.2s ease-in-out;"
                                onmouseover="this.style.backgroundColor='#3e8e41';"
                                onmouseout="this.style.backgroundColor='#36bc6a';"
                                type="submit">
                                Login
                            </button>
                        </form>
                    </div>

                    <div class="text-center d-flex flex-column">
                        <a href="<?= base_url('/forgot-password') ?>" class="fw-bold mb-2"
                            style="color: #36bc6a; transition: all 0.2s ease-in-out;"
                            onmouseover="this.style.color='#3e8e41';"
                            onmouseout="this.style.color='#36bc6a';">Lupa Password?</a>
                        <p class="mb-0">
                            Belum punya akun?
                            <a href="/signup" class="fw-bold"
                                style="color: #36bc6a; transition: all 0.2s ease-in-out;"
                                onmouseover="this.style.color='#3e8e41';"
                                onmouseout="this.style.color='#36bc6a';">Daftar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>