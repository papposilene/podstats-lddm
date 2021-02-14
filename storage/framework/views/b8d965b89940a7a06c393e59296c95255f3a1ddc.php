<?php $__env->startSection('title', @ucfirst(__('app.about'))); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 row-cols-md-2 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">
                <?php echo ucfirst(__('app.about')); ?>
            </h5>
            <div class="card-body">
                        
            </div>
        </div>
    </div> 
                
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">
                <?php echo ucfirst(__('app.statistics')); ?>
            </h5>
            <div class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-podcast" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.podcasts')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($podcasts)); ?></span>
                </li>
                <a href="<?php echo e(route('public.episode.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.episodes')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($episodes)); ?></span>
                </a>
                <a href="<?php echo e(route('public.track.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-music" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.tracks')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($tracks)); ?></span>
                </a>
                <a href="<?php echo e(route('public.contact.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-users" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.contacts')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($contacts)); ?></span>
                </a>
                <a href="<?php echo e(route('public.manufacturer.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-industry" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.manufacturers')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($manufacturers)); ?></span>
                </a>
                <a href="<?php echo e(route('public.console.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-dice" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.consoles')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($consoles)); ?></span>
                </a>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-link" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.sources')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($sources)); ?></span>
                </li>
                <a href="<?php echo e(route('public.studio.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-terminal" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.studios')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($studios)); ?></span>
                </a>
                <a href="<?php echo e(route('public.genre.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-list-alt" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.genres')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($genres)); ?></span>
                </a>
                <a href="<?php echo e(route('public.game.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-gamepad" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.games')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($games)); ?></span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/about.blade.php ENDPATH**/ ?>