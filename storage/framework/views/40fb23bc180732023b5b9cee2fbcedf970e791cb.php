<?php $__env->startSection('title', @ucfirst(__('app.professionsList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-user-tie" aria-hidden="true"></i>
        <?php echo ucfirst(__('app.professionsList')); ?>
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalProfessionCreate">
                <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.professionCreate')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.professionCreate')); ?></span>
            </button>
        </div>
        <?php endif; ?>
        <form action="<?php echo e(route('admin.profession.index')); ?>" method="POST">
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

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center"><?php echo ucfirst(__('app.profession')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.professionEpisode')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.professionGame')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center">
                    <?php echo e($loop->iteration); ?>

                </td>
                <td>
                    <?php echo e($profession->profession); ?>

                </td>
                <td class="text-center">
                    <?php echo e(count($profession->workAsInEpisode)); ?>

                </td>
                <td class="text-center">
                    <?php echo e(count($profession->workAsInGame)); ?>

                </td>
                <td class="text-center">
                    <a href="<?php echo e(route('admin.profession.show', ['uuid' => $profession->uuid])); ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.professionLook')); ?>"></i>
                        <span class="sr-only"><?php echo ucfirst(__('app.professionLook')); ?></span>
                    </a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.professionCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/profession/admin.blade.php ENDPATH**/ ?>