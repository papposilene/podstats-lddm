<?php $__env->startSection('title', @ucfirst(__('app.seriesList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-stream" aria-hidden="true"></i>
        <?php echo ucfirst(__('app.seriesList')); ?>
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalSerieCreate">
                <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.serieCreate')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.serieCreate')); ?></span>
            </button>
        </div>
        <?php endif; ?>
        <form action="<?php echo e(route('admin.serie.index')); ?>" method="POST">
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

<?php echo e($series->links()); ?>


<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center"><?php echo ucfirst(__('app.serieName')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.serieOrder')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.gameTitle')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.gameExists')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center">
                    <?php echo e($loop->iteration); ?>

                </td>
                <td>
                    <?php echo e($serie->serie); ?>

                </td>
                <td class="text-center">
                    <?php echo e($serie->number); ?>

                </td>
                <td>
                    <?php echo e($serie->game); ?>

                </td>
                <td class="text-center">
                    <?php if($serie->inPodcast): ?>
                    <i class="fas fa-check text-success aria-hidden="true" aria-label="<?php echo ucfirst(__('app.delete')); ?>"></i>
                    <?php else: ?>
                    <i class="fas fa-times text-danger aria-hidden="true" aria-label="<?php echo ucfirst(__('app.delete')); ?>"></i>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                    <form method="POST" action="<?php echo e(route('admin.serie.delete')); ?>" class="">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="serie_uuid" value ="<?php echo e($serie->uuid); ?>" />
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
    
<?php echo e($series->links()); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.serieCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/game/series.blade.php ENDPATH**/ ?>