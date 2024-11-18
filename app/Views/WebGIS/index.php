<?= $this->extend('layouts/base'); ?>

<?= $this->section('title'); ?>IKS | WebGIS<?= $this->endSection(); ?>

<?= $this->section('additionalHead'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- leaflet logic helper -->
<script src="<?= base_url('js/leaflet_helper.js') ?>"></script>
<!-- leaflet compass -->
<script src="<?= base_url('leaflet-compass/src/leaflet-compass.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('leaflet-compass/src/leaflet-compass.css') ?>">
</link>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main>
    <div>
        <div id="map" style="width: calc(100vw-2px); height: calc(100vh - 64px);"></div>
        <div style="width:fit-content;position: absolute; z-index: 999999; bottom: 30px; left: 20px;">
            <div class="d-flex p-3 rounded-3 bg-light flex-column">
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

            <div class="d-flex p-3 rounded-3 bg-light mt-3">
                <form>
                    <?php foreach ($kalurahan as $key => $value): ?>
                        <div class="form-check">
                            <input class="form-check-input" style="background-color: #36bc6a; border-color: #36bc6a" type="checkbox" value="<?= $value ?>" id="checklist-<?= $value ?>" name="checklist[]" checked>
                            <label class="form-check-label" for="checklist-<?= $value ?>">
                                Kalurahan <?= ucfirst($value) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
        </div>

    </div>

</main>


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

    const checkboxes = document.getElementsByName('checklist[]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            clearMap(map);

            const checkedGeoJSONs = [];

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    switch (checkbox.id) {
                        case 'checklist-sidoarum':
                            checkedGeoJSONs.push(sidoarumIKS);
                            break;
                        case 'checklist-sidorejo':
                            checkedGeoJSONs.push(sidorejoIKS);
                            break;
                        case 'checklist-sidokarto':
                            checkedGeoJSONs.push(sidokartoIKS);
                            break;
                    }
                }
            });

            checkedGeoJSONs.forEach(data => {
                loadGeoJSON(data);
            });
        });
    });
</script>
<?= $this->endSection(); ?>