<?php $__env->startSection('title', $game->title); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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
                    <i class="fas fa-gamepad" aria-hidden="true"></i>
					<?php echo e($game->title); ?>

                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                    <div class="btn-group mr-2">
                        <a href="<?php echo e(route('admin.game.edit', ['uuid' => $game->uuid])); ?>" role="button" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.consoleCreate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.consoleCreate')); ?></span>
                        </a>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('admin.game.index')); ?>" method="POST">
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
                
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3">
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <p class="text-white text-center">
                                <i class="fas fa-terminal" aria-hidden="true"></i>
                                <?php if($game->createdBy): ?>
                                <a href="<?php echo e(route('admin.studio.show', ['uuid' => $game->studio_uuid])); ?>" class="text-white">
                                    <?php echo e($game->createdBy->studio); ?>

                                </a>
                                <?php else: ?>
                                <?php echo ucfirst(__('app.studioUnknown')); ?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-calendar-check"></i>
                                <?php if($game->released_on): ?>
                                <?php echo ($game->released_on)->format('d/m/Y'); ?>
                                <?php else: ?>
                                ---
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="text-white text-center">
                                <i class="fas fa-list-ul"></i>
                                <?php $__currentLoopData = json_decode($game->mode); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo ucfirst(__('app.game' . ucfirst($mode))); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="text-white text-center">
                                <i class="fas fa-list-alt"></i>
                                <?php $__currentLoopData = $game->genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('admin.genre.show', ['uuid' => $genre->uuid])); ?>" class="text-white">
                                    <?php echo e($genre->genre); ?>

                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                
            <h2 class="h4 text-white pt-3 pb-2">
                <i class="fas fa-users" aria-hidden="true"></i>
                <?php echo ucfirst(__('app.staffList')); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                <div class="btn-group mr-2 float-right">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalStaffAdd">
                        <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.staffCreate')); ?>"></i>
                        <span class="sr-only"><?php echo ucfirst(__('app.staffCreate')); ?></span>
                    </button>
                </div>
                <?php endif; ?>
            </h2>
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo ucfirst(__('app.uname')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.profession')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $game->worksInGame; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($staff->worker->uname); ?></td>
                            <td><?php echo e($staff->worksAs->profession); ?></td>
                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                <form method="POST" action="<?php echo e(route('admin.unstaff')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="staff_uuid" value ="<?php echo e($staff->uuid); ?>" />
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('admin.contact.show', ['uuid' => $staff->uuid])); ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.search')); ?>"></i>
                                    </a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                                    <a href="<?php echo e(route('admin.contact.edit', ['uuid' => $staff->uuid])); ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.edit')); ?>"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash" aria-hidden="true" title="<?php echo ucfirst(__('app.delete')); ?>"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/game/show.blade.php ENDPATH**/ ?>