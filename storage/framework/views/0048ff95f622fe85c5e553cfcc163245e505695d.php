<?php $__env->startSection('title', @ucfirst(__('app.countriesStats'))); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.continentsStats')); ?></h1>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $continents_has_contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo e(__('app.' . $key)); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e($value); ?></span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statContinents')); ?></h3>
            <div class="card-body">
                <canvas id="statsContinents" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statCountriesTop10')); ?></h3>
            <div class="card-body">
                <canvas id="statsCountries" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-5">
    <?php $__currentLoopData = $regions_has_contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ckey => $cvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo e(__('app.' . $ckey)); ?></h1>
            <div class="list-group list-group-flush">
                <?php $__currentLoopData = $cvalue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rkey => $rvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $modal = str_replace(" ", "", $rkey);
                ?>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modal<?php echo e($modal); ?>List">
                    <span><?php echo e(__('app.' . $rkey)); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e($rvalue); ?></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__currentLoopData = $regions_has_contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ckey => $cvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $cvalue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rkey => $rvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$modal = str_replace(" ", "", $rkey);
?>
<div class="modal fade" id="modal<?php echo e($modal); ?>List" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal<?php echo e($modal); ?>ListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal<?php echo e($modal); ?>ListTitle">
                    <?php echo e(__('app.' . $rkey)); ?>

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush mb-3">
                    <?php $__currentLoopData = $countries->whereStrict('subregion', $rkey); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <span><?php echo e($country->flag); ?> <?php echo e($country->name_eng_common); ?></span><br />
                        <?php if(count($contacts->whereStrict('lives_at', $country->uuid)) > 0): ?>
                        <a href="<?php echo e(route('public.contact.index', [ 'cca3' => $country->cca3])); ?>">
                            <span>
                                <?php echo ucfirst(__('app.countryWithContacts', ['count' => count($contacts->whereStrict('lives_at', $country->uuid))])); ?>
                            </span>
                        </a></br>
                        <?php else: ?>
                        <span class="text-muted">
                            <?php echo ucfirst(__('app.countryWithoutContact')); ?>
                        </span><br />
                        <?php endif; ?>
                        <?php if(count($manufacturers->whereStrict('country_uuid', $country->uuid)) > 0): ?>
                        <a href="<?php echo e(route('public.manufacturer.index', [ 'cca3' => $country->cca3])); ?>">
                            <span>
                                <?php echo ucfirst(__('app.countryWithManufacturers', ['count' => count($manufacturers->whereStrict('country_uuid', $country->uuid))])); ?>
                            </span>
                        </a></br>
                        <?php else: ?>
                        <span class="text-muted">
                            <?php echo ucfirst(__('app.countryWithoutManufacturer')); ?>
                        </span><br />
                        <?php endif; ?>
                        <?php if(count($studios->whereStrict('country_uuid', $country->uuid)) > 0): ?>
                        <a href="<?php echo e(route('public.studio.index', [ 'cca3' => $country->cca3])); ?>">
                            <span>
                                <?php echo ucfirst(__('app.countryWithStudios', ['count' => count($studios->whereStrict('country_uuid', $country->uuid))])); ?>
                            </span>
                        </a>
                        <?php else: ?>
                        <span class="text-muted">
                            <?php echo ucfirst(__('app.countryWithoutStudio')); ?>
                        </span><br />
                        <?php endif; ?>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$.getJSON("<?php echo e(route('api.episode.continents')); ?>", function (json) {
    var pieContinents = document.getElementById('statsContinents').getContext('2d');
    var arrContinents = $.makeArray( json.chart );
    var labels = $.map(arrContinents, function(item) {
        return item.labels;
    });
    var continents = $.map(arrContinents, function(item) {
        return item.data;
    });
    var chartContinents = new Chart(pieContinents, {
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
                position: 'bottom'
            }
        }
    });
});
$.getJSON("<?php echo e(route('api.contact.countries', ['count' => 10])); ?>", function (json) {
    var pieCountries = document.getElementById('statsCountries').getContext('2d');
    var arrCountries = $.makeArray( json.chart );
    var labels = $.map(arrCountries, function(item) {
        return item.labels;
    });
    var countries = $.map(arrCountries, function(item) {
        return item.data;
    });
    var chartCountries = new Chart(pieCountries, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: countries,
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
var options = {
  valueNames: [ 'country-name' ]
};
var countriesList = new List('users', options);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/statistics/country.blade.php ENDPATH**/ ?>