<?php $__env->startSection('title', $studio->studio); ?>

<?php $__env->startSection('content'); ?>
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-terminal" aria-hidden="true"></i>
                    <?php echo e($studio->studio); ?>

                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <form action="<?php echo e(route('admin.studio.search')); ?>" method="POST">
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
                
            <h2 class="h4 text-white pt-3 pb-2">
                <?php echo ucfirst(__('app.gamesList')); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                <a href="<?php echo e(route('admin.game.create')); ?>" role="button" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.gameCreate')); ?>"></i>
                    <span class="sr-only"><?php echo ucfirst(__('app.gameCreate')); ?></span>
                </a>
                <?php endif; ?>
            </h2>
            <div class="table-responsive">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo ucfirst(__('app.title')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.releasedOn')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.consoles')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $studio->hasGames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($game->title); ?></td>
                            <td class="text-center">
                                <?php if($game->released_on): ?>
                                <?php echo ($game->released_on)->format('d/m/Y'); ?>
                                <?php else: ?>
                                00/00/0000
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php echo e(count($game->hasConsoles)); ?>

                            </td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.game.show', ['uuid' => $game->uuid])); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.showData')); ?>"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/studio/show.blade.php ENDPATH**/ ?>