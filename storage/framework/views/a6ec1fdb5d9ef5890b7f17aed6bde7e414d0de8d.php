<?php $__env->startSection('title', @ucfirst(__('app.tracksList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card-body d-flex h-100">
                <h1 class="card-title text-center align-self-center w-100"><?php echo ucfirst(__('app.tracksList')); ?></h1>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="<?php echo e(route('public.contact.index')); ?>" class="list-group-item d-flex justify-content-between align-items-center">
                        <span><?php echo ucfirst(__('app.statContactTotal')); ?></span>
                        <span class="badge badge-primary badge-pill"><?php echo e($totalContacts); ?></span>
                    </a>
                    <a href="<?php echo e(route('public.game.index')); ?>" class="list-group-item d-flex justify-content-between align-items-center">
                        <span><?php echo ucfirst(__('app.statGameTotal')); ?></span>
                        <span class="badge badge-primary badge-pill"><?php echo e($totalGames); ?></span>
                    </a>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span><?php echo ucfirst(__('app.statTrackTotal')); ?></span>
                        <span class="badge badge-primary badge-pill"><?php echo e($totalTracks); ?></span>
                    </div>
                </div>
                <form action="<?php echo e(route('public.track.search')); ?>" method="POST" class="card-body">
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
            </div>
        </div>
        <div class="col-md-12">
            <nav class="nav nav-pills flex-column flex-sm-row mx-3 mb-3">
                <a href="<?php echo e(route('public.track.type', ['type' => 'actuality'])); ?>" class="flex-sm-fill text-sm-center nav-link">
                    <?php echo ucfirst(__('app.trackTypeActuality')); ?>
                </a>
                <a href="<?php echo e(route('public.track.type', ['type' => 'tracklist'])); ?>" class="flex-sm-fill text-sm-center nav-link">
                    <?php echo ucfirst(__('app.trackTypeTracklist')); ?>
                </a>
                <a href="<?php echo e(route('public.track.type', ['type' => 'guest'])); ?>" class="flex-sm-fill text-sm-center nav-link">
                    <?php echo ucfirst(__('app.trackTypeGuest')); ?>
                </a>
                <a href="<?php echo e(route('public.track.type', ['type' => 'cover'])); ?>" class="flex-sm-fill text-sm-center nav-link">
                    <?php echo ucfirst(__('app.trackTypeCover')); ?>
                </a>
            </nav>
        </div>
    </div>
</div>

<?php echo e($tracks->links()); ?>            

<div class="row">
    <?php $__currentLoopData = $tracks->chunk(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('public.track.show', ['uuid' => $track->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    <?php echo e($track->title); ?><br />
                    <em><?php echo e($track->hasGame->title); ?>, <?php if($track->hasGame->released_on): ?> <?php echo ($track->hasGame->released_on)->format('Y'); ?>. <?php else: ?> 0000. <?php endif; ?></em>
                </span>
                <span class="badge badge-primary badge-pill">></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo e($tracks->links()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
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
    var chartConsoles = new Chart(pieModes, {
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/track/index.blade.php ENDPATH**/ ?>