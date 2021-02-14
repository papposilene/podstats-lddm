<?php $__env->startSection('title', @ucfirst(__('app.admin'))); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-home" aria-hidden="true"></i>
        <?php echo ucfirst(__('app.admin')); ?>
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalUserUpdate">
                <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.userUpdate')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.userUpdate')); ?></span>
            </button>
        </div>
        <form action="<?php echo e(route('admin.index')); ?>" method="POST">
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
            
<div class="row row-cols-1 row-cols-md-3">
    <div class="col mb-4">
        <div class="card">
            <div class="card-header">
                <?php echo ucfirst(__('app.podcastStats')); ?>
            </div>
            <div class="list-group list-group-flush">
                <a href="<?php echo e(route('admin.podcast.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-podcast" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.podcasts')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($podcasts)); ?></span>
                </a>
                <a href="<?php echo e(route('admin.episode.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.episodes')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($episodes)); ?></span>
                </a>
                <a href="<?php echo e(route('admin.track.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-music" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.tracks')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($tracks)); ?></span>
                </a>
            </div>
            <div class="card-footer text-right">
                <small>Featured</small>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <div class="card-header">
                <?php echo ucfirst(__('app.statContact')); ?>
            </div>
            <div class="list-group list-group-flush">
                <a href="<?php echo e(route('admin.profession.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.professions')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($professions)); ?></span>
                </a>
                <a href="<?php echo e(route('admin.contact.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-users" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.contacts')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($contacts)); ?></span>
                </a>
                <a href="<?php echo e(route('admin.source.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-link" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.sources')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($sources)); ?></span>
                </a>
            </div>
            <div class="card-footer text-right">
                <small>Featured</small>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <div class="card-header">
                <?php echo ucfirst(__('app.statGame')); ?>
            </div>
            <div class="list-group list-group-flush">
                <a href="<?php echo e(route('admin.manufacturer.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-industry" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.manufacturers')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($manufacturers)); ?></span>
                </a>
                <a href="<?php echo e(route('admin.console.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-dice" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.consoles')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($consoles)); ?></span>
                </a>
                <a href="<?php echo e(route('admin.studio.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-terminal" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.studios')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($studios)); ?></span>
                </a>
                <a href="<?php echo e(route('admin.genre.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-list-alt" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.genres')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($genres)); ?></span>
                </a>
                <a href="<?php echo e(route('admin.serie.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-stream" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.series')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($series)); ?></span>
                </a>
                <a href="<?php echo e(route('admin.game.index')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-gamepad" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.games')); ?>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($games)); ?></span>
                </a>
            </div>
            <div class="card-footer text-right">
                <small>Featured</small>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('modals.userUpdate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/index.blade.php ENDPATH**/ ?>