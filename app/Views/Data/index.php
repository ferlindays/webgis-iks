<?= $this->extend('layouts/base'); ?>

<?= $this->section('title'); ?>IKS | Data<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<main class="container mt-3">
    <?php if (session('errors.message')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session('errors.message') ?>
        </div>
    <?php endif ?>

    <?php if (session('success.message')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session('success.message') ?>
        </div>
    <?php endif ?>

    <div class="d-flex justify-content-between">
        <h3>Data Nilai Indeks Keluarga Sehat (IKS)</h3>
        <div class="d-flex gap-2">
            <a href="/data/export">
                <button class="btn w-12 text-white" style="background-color: #36bc6a; transition: all 0.2s ease-in-out;"
                    onmouseover="this.style.backgroundColor='#3e8e41';"
                    onmouseout="this.style.backgroundColor='#36bc6a';">Export</button>
            </a>

            <form class="d-flex mr-1" role="search" action="/data?search_query" method="get">
                <input class="form-control me-2 " type="search" placeholder="Cari..." aria-label="Search" value="<?= $query ?? '' ?>" name="search_query" onKeyDown="if(event.keyCode==13){this.form.submit();}">
            </form>
        </div>

    </div>


    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Fasilitas Kesehatan</th>
                <th scope="col">Kalurahan</th>
                <th scope="col">Padukuhan</th>
                <th scope="col">Nilai IKS</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Diperbaharui</th>
                <?php if (session('authUser')): ?>
                    <th scope="col">Aksi</th>
                <?php endif ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($data as $key => $item): ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $item['faskes'] ?></td>
                    <td><?= $item['kalurahan']  ?></td>
                    <td><?= $item['padukuhan'] ?></td>
                    <td><?= $item['iks'] ?></td>
                    <td><?= $item['created_at'] ?></td>
                    <td><?= $item['updated_at'] ?></td>
                    <?php if (session('authUser')): ?>
                        <td class="d-flex gap-2">
                            <a href="<?= base_url('data/' . $item['id']) ?>">
                                <button class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </a>

                            <form action="<?= base_url('data/' . $item['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </div>

    <?= $this->endSection(); ?>