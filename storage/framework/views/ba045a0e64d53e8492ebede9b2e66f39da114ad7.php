<?php $__env->startSection('title', @ucfirst(__('app.manufacturersList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <div class="row">
        <main role="main" class="col-12">
            <?php if($errors->any()): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <div class="col alert alert-danger">
                    <ol>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="text-danger"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <?php echo ucfirst(__('app.manufacturersList')); ?>
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <form action="<?php echo e(route('public.manufacturer.search')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="<?php echo ucfirst(__('app.search')); ?>" aria-label="<?php echo ucfirst(__('app.search')); ?>">
							<div class="input-group-append">
                                <button type="submit" class="bg-dark border border-secondary btn-sm text-white">
                                    <i class="fas fa-search" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.search')); ?>"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div id="map" class="leaflet-map"></div>
			
        </main>
    </div>
</div>
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
    
    var map = L.map('map').setView([25, 0], 2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/light-v9',
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
            '<p>' + feature.properties.flag + ' ' + feature.properties.name_common + '</p>' +
            '<p><?php echo ucfirst(__('app.consoles')); ?> : ' + feature.properties.consoles + '</p>',
            {
                'className' : 'leaflet-custom'
            });
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/manufacturer/globe.blade.php ENDPATH**/ ?>