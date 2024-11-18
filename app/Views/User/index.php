<?= $this->extend('layouts/base') ?>;

<?= $this->section('title'); ?>IKS | Admin & Operator<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<main class="container mt-3">
    <h3>Admin & Operator</h3>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Email</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($data as $key => $item): ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $item['email'] ?></td>
                    <td><?= $item['username'] ?></td>
                    <td><?= $item['role'] ?></td>
                    <td class="d-flex gap-1">
                        <a href="<?= base_url('users/' . $item['id']) ?>">
                            <button class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </a>
                        <?php if (session('authUser')['id'] != $item['id']): ?>
                            <form action="<?= base_url('users/' . $item['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </div>

    <?= $this->endSection(); ?>