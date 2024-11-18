<?= $this->extend('layouts/base'); ?>

<?= $this->section('title'); ?>IKS | User<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh">
    <div class="col-12 col-md-8 col-lg-6 col-xl-4">
        <div class="card " style="border-radius: 1rem">
            <div class="card-body p-5 ">
                <div class="mb-md-3 mt-md-4">
                    <p><?= session('errors.message') ?></p>
                    <form class="form" action="<?= base_url('/users/' . $data['id']) ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div data-mdb-input-init class="form-outline form-white mb-4">
                            <label class="mb-1 fw-bold" for="email">Email</label>
                            <input
                                class="form-control"
                                id="email"
                                name="email"
                                type="text"
                                placeholder="Email"
                                value="<?= $data['email'] ?>"
                                <?= session('authUser')['id'] == $data['id'] ? '' : 'disabled' ?> />
                            <span class="text-danger text-sm d-block ml-1"><?= $errors['email'] ?? '' ?></span>
                        </div>

                        <div data-mdb-input-init class="form-outline form-white mb-4">
                            <label class="mb-1 fw-bold" for="username">Username</label>
                            <input
                                class="form-control"
                                id="username"
                                name="username"
                                type="text"
                                placeholder="Username"
                                value="<?= $data['username'] ?>"
                                <?= session('authUser')['id'] == $data['id'] ? '' : 'disabled' ?> />
                            <span class="text-danger text-sm d-block ml-1"><?= $errors['username'] ?? '' ?></span>
                        </div>
                        <label class="mb-1 fw-bold" for="role">Role</label>
                        <select class="form-select" name="role" aria-label="Role">
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role ?>" <?= $data['role'] == $role ? 'selected' : '' ?>><?= ucfirst($role) ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button
                        onclick="window.history.back()"
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn btn-light"
                        type="button">
                        Batal
                    </button>

                    <button
                        data-mdb-button-init
                        data-mdb-ripple-init
                        class="btn"
                        style="background-color: #36bc6a; transition: all 0.2s ease-in-out;color: white;"
                        onmouseover="this.style.backgroundColor='#3e8e41';"
                        onmouseout="this.style.backgroundColor='#36bc6a';"
                        type="submit">
                        Simpan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>