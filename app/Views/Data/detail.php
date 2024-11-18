<?= $this->extend('layouts/base'); ?>

<?= $this->section('title'); ?>IKS | Ubah Data<?= $this->endSection(); ?>

<?= $this->section('additionalHead'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<main class="d-flex">
    <div class="col-md-2 p-3" style="min-width: 320px;">
        <h3>Ubah Data</h3>
        <hr>
        <form class="form" action="<?= base_url('/data/' . $data['id']) ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <div data-mdb-input-init class="form-outline form-white mb-4">
                <label class="mb-1 fw-bold" for="faskes">Fasilitas Kesehatan</label>
                <input
                    class="form-control"
                    id="faskes"
                    name="faskes"
                    type="text"
                    placeholder="Fasilitas Kesehatan"
                    value="<?= $data['faskes'] ?>" />
                <span class="text-danger text-sm d-block ml-1"><?= session('errors.faskes') ?? '' ?></span>
            </div>

            <div class="form-outline form-white mb-4">
                <label class="mb-1 fw-bold" for="kalurahan">Kalurahan</label>
                <select class="form-select" name="kalurahan" aria-label="Kalurahan">
                    <?php foreach ($kalurahan as $key => $item): ?>
                        <option value="<?= $item ?>" <?= $data['kalurahan'] == $item ? 'selected' : '' ?>><?= ucfirst($item) ?></option>
                    <?php endforeach ?>
                </select>
                <span class="text-danger text-sm d-block ml-1"><?= session('errors.kalurahan') ?? '' ?></span>
            </div>

            <div data-mdb-input-init class="form-outline form-white mb-4">
                <label class="mb-1 fw-bold" for="padukuhan">Padukuhan</label>
                <input
                    class="form-control"
                    id="padukuhan"
                    name="padukuhan"
                    type="text"
                    placeholder="Padukuhan"
                    value="<?= $data['padukuhan'] ?>" />
                <span class="text-danger text-sm d-block ml-1"><?= session('errors.padukuhan') ?? '' ?></span>
            </div>

            <div data-mdb-input-init class="form-outline form-white mb-4">
                <label class="mb-1 fw-bold" for="iks">Indeks Keluarga Sehat (IKS)</label>
                <input
                    class="form-control"
                    id="iks"
                    name="iks"
                    type="number"
                    step="0.001"
                    placeholder="Nilai IKS"
                    value="<?= $data['iks'] ?>" />
                <span class="text-danger text-sm d-block ml-1"><?= session('errors.iks') ?? '' ?></span>
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
    <div id="map" style="width: 100vw; height: 100vh;"></div>
</main>

<script>
    const map = L.map('map').setView([-7.767431356794746, 110.28872430663957], 13);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
</script>
<?= $this->endSection(); ?>