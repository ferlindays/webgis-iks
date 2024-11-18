<?= $this->extend('layouts/base'); ?>

<?= $this->section('title'); ?>IKS | Kalurahan<?= $this->endSection(); ?>


<?= $this->section('content') ?>

<main>
    <div class="container mt-4">
        <h3 class="mb-5 text-center fw-bold" style="color: #36bc6a;">Kalurahan <?= ucfirst($kalurahan) ?></h3>

        <div class="d-flex flex-wrap justify-content-center gap-5">
            <?php foreach ($padukuhan as $value): ?>
                <div class="rounded-circle d-flex justify-content-center align-items-center p-3 border "
                    style="height: 180px; width: 180px; border-width: 16px !important; border-color: #D7FFE8 !important;">
                    <h5 class="mb-0 text-center" style="color: #36bc6a;">Padukuhan <?= ucfirst($value) ?></h5>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>