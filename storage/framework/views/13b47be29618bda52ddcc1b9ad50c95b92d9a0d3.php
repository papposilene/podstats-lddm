<?php $__env->startSection('title', $console->name); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo e($console->name); ?></h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <a href="<?php echo e(route('public.manufacturer.show', ['uuid' => $console->byManufacturer->uuid])); ?>" class="text-white">
                            <?php echo e($console->byManufacturer->company); ?>

                        </a>
                    </span>
                    <span class="float-right"><?php echo e($console->byManufacturer->locatedAt->flag); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo ucfirst(__('app.' . $console->type)); ?>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statGameTotal')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($console->hasGames)); ?></span>
                </li>
            </ul>
            <form action="<?php echo e(route('public.game.search')); ?>" method="POST" class="card-body">
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
            <div class="card-footer text-center">
                <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($console->updated_at)->format('d/m/Y @ H:i'); ?></small>
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
</div>

<?php echo e($games->links()); ?>


<div class="row">
    <?php $__currentLoopData = $games->chunk(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('public.game.show', ['uuid' => $game->game_uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    <strong><?php echo e($game->hasGame->title); ?></strong>, <?php if($game->hasGame->released_on): ?> <?php echo ($game->hasGame->released_on)->format('Y'); ?> <?php else: ?> 19?? <?php endif; ?><br />
                    <em><?php echo e($game->hasGame->createdBy->locatedAt->flag); ?> <?php echo e($game->hasGame->createdBy->studio); ?></em>
                </span>
                <span class="badge badge-primary badge-pill">></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo e($games->links()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$.getJSON("<?php echo e(route('api.console.genres', ['uuid' => $console->uuid, 'count' => 10])); ?>", function (json) {
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/console/show.blade.php ENDPATH**/ ?>