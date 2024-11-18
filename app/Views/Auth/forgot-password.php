<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>IKS | Forgot Password</title>
</head>

<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <div class="col-12 col-md-8 col-lg-6 col-xl-4">
            <div class="card " style="border-radius: 1rem">
                <div class="card-body p-5">
                    <div class="mb-md-3 mt-md-4">
                        <h2 class="fw-bold mb-4 text-uppercase">Kontak Admin</h2>
                        <p>Silahkan hubungi admin melalui e-mail <span style="color: #36bc6a;"><?= $data['email'] ?></span></p>
                        <a href="<?= session('redirect_back') ?? base_url('/signin') ?>" class="btn btn-outline-secondary w-100">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>