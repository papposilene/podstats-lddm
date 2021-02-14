<?php $__env->startSection('title', @ucfirst(__('app.seasonsStats'))); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.seasonsStats')); ?></h1>
            <div class="list-group list-group-flush">
                <a href="<?php echo e(route('public.stats.episodes')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <?php echo ucfirst(__('app.podcastStats')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('public.stats.seasons', ['season' => $season->season])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <?php echo ucfirst(__('app.seasonStats', ['season' => $season->season])); ?>
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/statistics/seasons.blade.php ENDPATH**/ ?>