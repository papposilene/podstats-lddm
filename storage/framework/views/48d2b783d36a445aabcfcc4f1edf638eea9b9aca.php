<?php $__env->startSection('title', @ucfirst(__('app.statStudio'))); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statStudioMap')); ?></h3>
            <div id="map" class="card-body leaflet-map-big"></div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header"><?php echo ucfirst(__('app.statContinents')); ?></h5>
            <div class="card-body">
                <canvas id="statsContinents" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statGameTop10Genres')); ?></h3>
            <div class="card-body">
                <canvas id="statsGenres" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statModes')); ?></h3>
            <div class="card-body">
                <canvas id="statsModes" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.statStudioTop20')); ?></h1>
            <div class="list-group list-group-flush">
                <a href="<?php echo e(route('public.studio.index')); ?>" class="bg-info list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statStudioTotal')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($studios)); ?></span>
                </a>
                <?php $__currentLoopData = $top20Studios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eachStudio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('public.studio.show', ['uuid' => $eachStudio->studio_uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        #<?php echo e($loop->iteration); ?>. <strong><?php echo e($eachStudio->createdBy->studio); ?></strong>.<br />
                        <em><?php echo e($eachStudio->createdBy->locatedAt->flag); ?> <?php echo e($eachStudio->createdBy->locatedAt->name_eng_common); ?>.</em>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e($eachStudio->studio_count); ?></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$.getJSON("<?php echo e(route('api.studio.continents')); ?>", function (json) {
    var pieContinents = document.getElementById('statsContinents').getContext('2d');
    var arrContinents = $.makeArray( json.chart );
    var labels = $.map(arrContinents, function(item) {
        return item.labels;
    });
    var continents = $.map(arrContinents, function(item) {
        return item.data;
    });
    var chartGender = new Chart(pieContinents, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: continents,
                    borderColor: '#000',
                    backgroundColor: [
                        '#000', // Africa
                        '#dc3545', // Americas
                        '#fff', // Antartic
                        '#ffed4a', // Asia
                        '#3490dc', // Europa
                        '#38c172', // Oceania
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
$.getJSON("<?php echo e(route('api.game.genres', ['count' => 10])); ?>", function (json) {
    var pieGenres = document.getElementById('statsGenres').getContext('2d');
    var arrGenres = $.makeArray( json.chart );
    var labels = $.map(arrGenres, function(item) {
        return item.labels;
    });
    var genres = $.map(arrGenres, function(item) {
        return item.data;
    });
    var chartGenres = new Chart(pieGenres, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: genres,
                    borderColor: '#000',
                    backgroundColor: [
                        '#b11312',
                        '#3490dc',
                        '#ffed4a',
                        '#38c172',
                        '#dc3545',
                        '#6cb2eb',
                        '#f6993f',
                        '#6574cd',
                        '#4dc0b5',
                        '#9561e2',
                        '#f66d9b'
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
                position: 'bottom'
            }
        }
    });
});
$.getJSON("<?php echo e(route('api.game.modes')); ?>", function (json) {
    var pieModes = document.getElementById('statsModes').getContext('2d');
    var arrModes = $.makeArray( json.chart );
    var labels = $.map(arrModes, function(item) {
        return item.labels;
    });
    var modes = $.map(arrModes, function(item) {
        return item.data;
    });
    var chartModes = new Chart(pieModes, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: modes,
                    borderColor: '#000',
                    backgroundColor: [
                        '#f66d9b',
                        '#6cb2eb',
                        '#cc65fe',
                        '#ffce56'
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
                position: 'bottom'
            }
        }
    });
});

var countries = $.ajax({
    url: "<?php echo e(route('api.studio.geojson')); ?>",
    dataType: "json",
    success: console.log("Studios data successfully loaded."),
    error: function(xhr) {
        alert(xhr.statusText)
    }
});

var map = L.map('map').setView([40, 0], 2);
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
        layer.bindPopup('<h5>' + feature.properties.studio + '</h5>' +
        '<ul class="list-unstyled">' +
        '<li>' + feature.properties.flag + ' ' + feature.properties.name_common + '</li>' +
        '</ul>');
    }
}
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/statistics/studio.blade.php ENDPATH**/ ?>