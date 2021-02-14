<?php $__env->startSection('title', @ucfirst(__('app.gamesList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?php if($errors->any()): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
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
                    <?php echo ucfirst(__('app.gamesList')); ?>
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                    <div class="btn-group mr-2">
						<a href="<?php echo e(route('admin.game.create')); ?>" role="button" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.gameCreate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.gameCreate')); ?></span>
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
            
			<?php echo e($games->links()); ?>

			
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo ucfirst(__('app.studio')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.title')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.releasedOn')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td>
								<?php if($game->createdBy): ?>
								<a href="<?php echo e(route('admin.studio.show', ['uuid' => $game->createdBy->uuid])); ?>"><?php echo e($game->createdBy->studio); ?></a>
								<?php else: ?>
								<?php echo ucfirst(__('app.studioUnknown')); ?>
								<?php endif; ?>
							</td>
                            <td><?php echo e($game->title); ?></td>
                            <td class="text-center">
                                <?php if($game->released_on): ?>
                                <?php echo ($game->released_on)->format('d/m/Y'); ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                <form method="POST" action="<?php echo e(route('admin.game.delete')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="game_uuid" value ="<?php echo e($game->uuid); ?>" />
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('admin.game.show', ['uuid' => $game->uuid])); ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                    </a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                                    <a href="<?php echo e(route('admin.game.edit', ['uuid' => $game->uuid])); ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
			
			<?php echo e($games->links()); ?>

			
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/game/admin.blade.php ENDPATH**/ ?>