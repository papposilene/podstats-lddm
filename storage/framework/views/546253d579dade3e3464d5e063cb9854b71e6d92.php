<?php $__env->startSection('title', @ucfirst(__('app.genresList'))); ?>

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
                    <i class="fas fa-list-alt" aria-hidden="true"></i>
                    <?php echo ucfirst(__('app.genresList')); ?>
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalGenreCreate">
                            <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.genreCreate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.genreCreate')); ?></span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('admin.genre.index')); ?>" method="POST">
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
                
            <?php echo e($genres->links()); ?>

            
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo ucfirst(__('app.genre')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.genreCount')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($genre->genre); ?></td>
                            <td class="text-center">
                                <?php echo e(count($genre->games)); ?>

                            </td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.genre.show', ['uuid' => $genre->uuid])); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.genreLook')); ?>"></i>
                                    <span class="sr-only"><?php echo ucfirst(__('app.genreLook')); ?></span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <?php echo e($genres->links()); ?>

            
        </main>
    </div>
</div>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.genreCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/genre/admin.blade.php ENDPATH**/ ?>