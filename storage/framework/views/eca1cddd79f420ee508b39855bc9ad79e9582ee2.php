<?php $__env->startSection('title', @ucfirst(__('app.tracksList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <div class="row">
        <main role="main" class="col-12">
            <?php if($errors->any()): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4">
                <div class="col alert alert-danger">
                    <ol>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="text-danger"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-music" aria-hidden="true"></i>
                    <?php echo ucfirst(__('app.tracksList')); ?>
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <form action="<?php echo e(route('admin.track.index')); ?>" method="POST">
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
                
            <?php echo e($tracks->links()); ?>

            
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo ucfirst(__('app.trackTitle')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.trackDate')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.trackDuration')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($track->title); ?></td>
                            <td class="text-center">
                                <?php if($track->released_on): ?>
                                <?php echo ($track->released_on)->format('d/m/Y'); ?>
                                <?php else: ?>
                                00/00/0000
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($track->duration): ?>
                                <?php echo ($track->duration)->format('d/m/Y'); ?>
                                <?php else: ?>
                                00:00:00
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                <form method="POST" action="<?php echo e(route('admin.track.delete')); ?>" class="">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="track_uuid" value ="<?php echo e($track->uuid); ?>" />
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                                    <a href="<?php echo e(route('admin.track.edit', ['uuid' => $track->uuid])); ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
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
            
            <?php echo e($tracks->links()); ?>

            
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/track/admin.blade.php ENDPATH**/ ?>