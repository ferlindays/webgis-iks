<?= $this->extend('layouts/base'); ?>
<?= $this->section('title'); ?>IKS | Tambah Data<?= $this->endSection(); ?>

<?= $this->section('additionalHead'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="<?= base_url('js/leaflet_helper.js') ?>"></script>
<!-- leaflet compass -->
<script src="<?= base_url('leaflet-compass/src/leaflet-compass.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('leaflet-compass/src/leaflet-compass.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<main class="d-flex">
    <div class="col-md-2 p-3" style="min-width: 320px;">
        <h3>Tambah Data</h3>
        <hr>
        <?php if (session('errors.message')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session('errors.message') ?>
            </div>
        <?php endif ?>
        <form class="form" action="<?= base_url('data') ?>" method="post">
            <?= csrf_field(); ?>
            <div data-mdb-input-init class="form-outline form-white mb-4">
                <label class="mb-1 fw-bold" for="faskes">Fasilitas Kesehatan</label>
                <input
                    class="form-control"
                    id="faskes"
                    name="faskes"
                    type="text"
                    placeholder="Fasilitas Kesehatan" />
                <span class="text-danger text-sm d-block ml-1"><?= session('errors.faskes') ?? '' ?></span>
            </div>

            <div class="form-outline form-white mb-4">
                <label class="mb-1 fw-bold" for="kalurahan">Kalurahan</label>
                <select class="form-select" name="kalurahan" aria-label="Kalurahan" id="kalurahan-option">
                    <option selected disabled>Pilih Kalurahan</option>
                    <?php foreach ($kalurahan as $key => $item): ?>
                        <option value="<?= $item ?>"><?= ucfirst($item) ?></option>
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
                    placeholder="Padukuhan" />
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
                    placeholder="Nilai IKS" />
                <span class="text-danger text-sm d-block ml-1"><?= session('errors.iks') ?? '' ?></span>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button
                    onclick="window.location.href='/data'"
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

    <div style="width:fit-content;position: absolute; z-index: 999999; bottom: 30px; left: 340px;">
        <div class="d-flex py-3 px-4 rounded-3 bg-light flex-column">
            <h6 class="text-center mb-3">Legenda</h6>
            <div class="d-flex gap-3 flex-column">
                <div class="d-flex align-items-center; gap-3">
                    <div style="width: 24px; height: 24px; background-color: rgb(255,173,171)"></div>
                    <caption>Sehat</caption>
                </div>
                <div class="d-flex align-items-center; gap-3">
                    <div style="width: 24px; height: 24px; background-color: rgb(255,110,87)"></div>
                    <caption>Pra Sehat</caption>
                </div>
                <div class="d-flex align-items-center; gap-3">
                    <div style="width: 24px; height: 24px; background-color: rgb(235,0,23)"></div>
                    <caption>TIdak Sehat</caption>
                </div>
            </div>

        </div>
    </div>
    <div id="map" style="width: 100vw; height: calc(100vh - 56px);"></div>
</main>
<script src="<?= base_url('leaflet-compass/src/leaflet-compass.js') ?>"></script>
<script>
    const map = L.map('map').setView([-7.765788739043061, 110.2921573820597], 14);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // show the map scale
    L.control.scale({
        position: 'bottomright'
    }).addTo(map);

    // add compass
    const compass = L.control.compass({
        autoActive: true, // Activate compass automatically
        showDigit: true, // Show compass angle in degrees
        position: 'topleft'
    });
    compass.addTo(map);

    const sidoarumIKS = <?= json_encode($sidoarum) ?>;
    const sidorejoIKS = <?= json_encode($sidorejo) ?>;
    const sidokartoIKS = <?= json_encode($sidokarto) ?>;

    loadGeoJSON(sidoarumIKS)
    loadGeoJSON(sidorejoIKS)
    loadGeoJSON(sidokartoIKS)

    document.getElementById('kalurahan-option').addEventListener('change', function() {
        clearMap(map);

        const selectedKalurahan = this.value;

        switch (selectedKalurahan) {
            case 'sidoarum':
                loadGeoJSON(sidoarumIKS)
                break;
            case 'sidorejo':
                loadGeoJSON(sidorejoIKS)
                break;
            case 'sidokarto':
                loadGeoJSON(sidokartoIKS)
                break;
        }
    });
</script>
<?= $this->endSection(); ?>