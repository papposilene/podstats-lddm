<?php $__env->startSection('title', @ucfirst(__('app.contactsList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.contactsList')); ?></h1>
            <form action="<?php echo e(route('public.contact.search')); ?>" method="POST" class="card-body">
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
                    <span><?php echo ucfirst(__('app.statContactTotal')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e($totalContacts); ?></span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statContactDead')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e($deadContacts); ?></span>
                </div>
                <a href="<?php echo e(route('public.stats.contacts')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statContact')); ?></span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <a href="<?php echo e(route('public.stats.countries')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.countriesStats')); ?></span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
            </div>
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
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statGenders')); ?></h3>
            <div class="card-body">
                <canvas id="statsGenders" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>

<?php echo e($contacts->links()); ?>


<div class="row">
<?php $__currentLoopData = $contacts->chunk(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('public.contact.show', ['uuid' => $contact->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    <strong><?php echo e($contact->uname); ?></strong><br />
                    <?php if($contact->livesAt): ?>
                    <em><?php echo e($contact->livesAt->flag); ?> <?php echo e($contact->livesAt->name_eng_common); ?>.</em>
                    <?php else: ?>
                    <em><?php echo ucfirst(__('app.contactLivesAtUnknown')); ?>.</em>
                    <?php endif; ?>
                </span>
                <span class="badge badge-primary badge-pill"><?php echo e(count($contact->hasTracks)); ?></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo e($contacts->links()); ?>

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
$.getJSON("<?php echo e(route('api.episode.genders')); ?>", function (json) {
    var pieGenders = document.getElementById('statsGenders').getContext('2d');
    var arrGenders = $.makeArray( json.chart );
    var labels = $.map(arrGenders, function(item) {
        return item.labels;
    });
    var genders = $.map(arrGenders, function(item) {
        return item.data;
    });
    var chartGender = new Chart(pieGenders, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: genders,
                    borderColor: '#000',
                    backgroundColor: [
                        '#ffce56',
                        '#f66d9b',
                        '#6cb2eb',
                        '#cc65fe',
                        '#adb5bd'
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/contact/index.blade.php ENDPATH**/ ?>