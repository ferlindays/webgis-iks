<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title><?= $this->renderSection('title'); ?></title>

    <?= $this->renderSection('additionalHead'); ?>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #36bc6a; color: white;">
            <div class="container-fluid">
                <a class="navbar-brand" href="/"><img src="/logo2.png" alt="logo" width="80" height="50"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a style="color: white;" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                DATA
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/data/kalurahan/sidokarto">Kalurahan Sidokarto</a></li>
                                <li><a class="dropdown-item" href="/data/kalurahan/sidorejo">Kalurahan Sidorejo</a></li>
                                <li><a class="dropdown-item" href="/data/kalurahan/sidoarum">Kalurahan Sidoarum</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a style="color: white;" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                TAMPILAN
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/data">Data IKS</a></li>
                                <li><a class="dropdown-item" href="/webgis">WebGIS IKS</a></li>
                                <li><a class="dropdown-item" href="/diagram">Diagram IKS</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a style="color: white;" role="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#infoModal">INFO</a>
                        </li>
                        <?php if (session('authUser')): ?>
                            <li class="nav-item dropdown">
                                <a style="color: white;" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    INPUT DATA
                                </a>

                                <ul class="dropdown-menu">
                                    <?php if (session('authUser')['role'] == 'admin'): ?>
                                        <li><a class="dropdown-item" href="/users">Kelola Admin & Operator</a></li>
                                    <?php endif ?>
                                    <li><a class="dropdown-item" href="/data/add">Indeks Keluarga Sehat (IKS)</a></li>
                                </ul>
                            </li>
                        <?php endif ?>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <?php if (session('authUser')): ?>
                            <li class="nav-item">
                                <form action="<?= base_url('/logout') ?>" method="post">
                                    <button style="color: white;" class="nav-link btn btn-link" type="submit">Logout</button>
                                </form>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a style="color: white;" class="nav-link" href="/signin">Login</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Info Modal -->
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-info-circle-fill"></i> Info</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Aplikasi Peta Indeks Keluarga Sehat (IKS) Puskesmas Godean II dibuat menggunakan Codeigniter 4 dan database PostgreSQL.</p>
                        <br>
                        <p>Dibuat oleh Ferlinda Yuni Setyawati.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?= $this->renderSection('content'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>