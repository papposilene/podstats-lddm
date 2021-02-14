<?php $__env->startSection('title', $manufacturer->company); ?>

<?php $__env->startSection('content'); ?>            
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">
                <?php echo e($manufacturer->company); ?>

                <span class="float-right"><?php echo e($manufacturer->locatedAt->flag); ?></span>
            </h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statConsoleTotal')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($manufacturer->hasConsoles)); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statGameTotal')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e($totalGames); ?></span>
                </li>
            </ul>
            <div id="map" class="card-body leaflet-map"></div>
            <p class="card-text text-center">
                <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($manufacturer->updated_at)->format('d/m/Y @ H:i'); ?></small>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header"><?php echo ucfirst(__('app.consolesList')); ?></h2>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $manufacturer->hasConsoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('public.console.show', ['uuid' => $console->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <strong><?php echo e($console->name); ?></strong><br />
                        <em><?php echo e($console->released_on); ?>. <?php echo ucfirst(__('app.' . $console->type)); ?>.</em>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($console->hasGames)); ?></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statConsoleTypes')); ?></h3>
            <div class="card-body">
                <canvas id="statsConsoles" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
<?php
$latlng = json_decode($manufacturer->locatedAt->latlng, true);
?>
var map = L.map('map', { zoomControl: false }).setView([<?php echo e($latlng['lng']); ?>, <?php echo e($latlng['lat']); ?>], 1);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    tileSize: 512,
    zoomOffset: -1
}).addTo(map);
L.marker([<?php echo e($latlng['lng']); ?>, <?php echo e($latlng['lat']); ?>]).addTo(map);

$.getJSON("<?php echo e(route('api.manufacturer.consoles', ['uuid' => $manufacturer->uuid])); ?>", function (json) {
    var pieConsoles = document.getElementById('statsConsoles').getContext('2d');
    var arrConsoles = $.makeArray( json.chart );
    var labels = $.map(arrConsoles, function(item) {
        return item.labels;
    });
    var consoles = $.map(arrConsoles, function(item) {
        return item.data;
    });
    var chartConsoles = new Chart(pieConsoles, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: consoles,
                    borderColor: '#000',
                    backgroundColor: [
                        '#3490dc',
                        '#9561e2',
                        '#dc3545',
                        '#f6993f',
                        '#38c172',
                        '#6cb2eb',
                        '#adb5bd' // Unknown
                    ]
                }
            ]
        },
        options: {
            title: {
                display: false
            },
            label: {
                fontColor: '#fff'
            },
            legend: {
                align: 'start',
                display: true,
                position: 'right'
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/manufacturer/show.blade.php ENDPATH**/ ?>