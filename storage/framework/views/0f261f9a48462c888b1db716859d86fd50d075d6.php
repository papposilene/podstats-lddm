<?php $__env->startSection('title', @ucfirst(__('app.manufacturersList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 row-cols-md-2 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.manufacturersList')); ?></h1>
            <form action="<?php echo e(route('public.manufacturer.search')); ?>" method="POST" class="card-body">
                <?php echo csrf_field(); ?>
                <div class="input-group">
                    <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="<?php echo ucfirst(__('app.search')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.search')); ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn bg-dark border border-secondary text-white">
                            <i class="fas fa-search" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.search')); ?>"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="list-group list-group-flush">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statManufacturerTotal')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e($totalManufacturers); ?></span>
                </div>
                <a href="<?php echo e(route('public.console.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statConsoleTotal')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e($totalConsoles); ?></span>
                </a>
                <a href="<?php echo e(route('public.game.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statGameTotal')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e($totalGames); ?></span>
                </a>
                <a href="<?php echo e(route('public.stats.manufacturers')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statMore')); ?></span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statManufacturerMap')); ?></h3>
            <div id="map" class="card-body leaflet-map"></div>
        </div>
    </div>
</div>

<?php echo e($manufacturers->links()); ?>


<div class="row">
    <?php $__currentLoopData = $manufacturers->chunk(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('public.manufacturer.show', ['uuid' => $manufacturer->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    <strong><?php echo e($manufacturer->company); ?></strong><br />
                    <em><?php echo e($manufacturer->locatedAt->flag); ?> <?php echo e($manufacturer->locatedAt->name_eng_common); ?></em>
                </span>
                <span class="badge badge-primary badge-pill"><?php echo e(count($manufacturer->hasConsoles)); ?></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo e($manufacturers->links()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
var countries = $.ajax({
    url: "<?php echo e(route('api.manufacturer.geojson')); ?>",
    dataType: "json",
    success: console.log("Manufacturers data successfully loaded."),
    error: function(xhr) {
        alert(xhr.statusText)
    }
});
    
var map = L.map('map').setView([40, 0], 1);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    tileSize: 512,
    zoomOffset: -1
}).addTo(map);

$.when(countries).done(function() {
    // Add requested external GeoJSON to map
    var kyCountries = L.geoJSON(countries.responseJSON, {
        onEachFeature: onEachFeature
    }).addTo(map);
});

function onEachFeature(feature, layer) {
    if (feature.properties) {
        layer.bindPopup('<h5>' + feature.properties.company + '</h5>' +
        '<ul class="list-unstyled">' +
        '<li>' + feature.properties.flag + ' ' + feature.properties.name_common + '</li>' +
        '<li><?php echo ucfirst(__('app.consoles')); ?> : ' + feature.properties.consoles + '</li>' +
        '</ul>');
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/manufacturer/index.blade.php ENDPATH**/ ?>