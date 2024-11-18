<?= $this->extend('layouts/base'); ?>

<?= $this->section('title'); ?>IKS | Diagram<?= $this->endSection(); ?>

<?= $this->section('additionalHead'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container mt-4">
        <h3 class="mb-2 text-center">Kalurahan Sidokarto</h3>
        <canvas id="sidokarto-barchart" height="100" class="mb-5"></canvas>

        <h3 class="mb-2 text-center">Kalurahan Sidorejo</h3>
        <canvas id="sidorejo-barchart" height="100" class="mb-5"></canvas>

        <h3 class="mb-2 text-center">Kalurahan Sidoarum</h3>
        <canvas id="sidoarum-barchart" height="100" class="mb-5"></canvas>
    </div>
</main>
<script>
    const initIKSChart = (canvasId, chartX, chartY) => {
        const chartData = {
            labels: chartX,
            datasets: [{
                label: 'IKS',
                data: chartY,
                backgroundColor: ['#7aa16c'],
            }]
        }
        const ctx = document.getElementById(canvasId).getContext('2d')
        const config = {
            type: 'bar',
            data: chartData
        }
        config.options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'Rata-rata IKS',
                    position: 'left'
                },
                subtitle: {
                    display: true,
                    text: 'Padukuhan',
                    position: 'bottom'
                }
            }
        }

        const myChart = new Chart(ctx, config);
    }

    // Function to initialize chart
    // chartX is an array of labels (padukuhan)
    // chartY is an array of data (IKS)
    const data = <?php echo json_encode($data) ?>;

    const [sidokartoX, sidokartoY] = data.filter(d => d.kalurahan === 'sidokarto').reduce(([x, y], d) => ([
        [...x, d.padukuhan],
        [...y, d.iks]
    ]), [
        [],
        []
    ]);

    const [sidorejoX, sidorejoY] = data.filter(d => d.kalurahan === 'sidorejo').reduce(([x, y], d) => ([
        [...x, d.padukuhan],
        [...y, d.iks]
    ]), [
        [],
        []
    ]);

    const [sidoarumX, sidoarumY] = data.filter(d => d.kalurahan === 'sidoarum').reduce(([x, y], d) => ([
        [...x, d.padukuhan],
        [...y, d.iks]
    ]), [
        [],
        []
    ]);

    initIKSChart('sidokarto-barchart', sidokartoX, sidokartoY);
    initIKSChart('sidorejo-barchart', sidorejoX, sidorejoY);
    initIKSChart('sidoarum-barchart', sidoarumX, sidoarumY);
</script>

<?= $this->endSection(); ?>