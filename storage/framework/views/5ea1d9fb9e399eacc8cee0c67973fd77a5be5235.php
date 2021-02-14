<?php $__env->startSection('title', @ucfirst(__('app.podcastsList'))); ?>

<?php $__env->startSection('content'); ?>            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <a href="<?php echo e(route('public.podcast.index')); ?>" class="text-white"><?php echo ucfirst(__('app.podcastsList')); ?></a>
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
					<form action="<?php echo e(route('public.podcast.index')); ?>" method="POST">
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
                            <th class="text-center">
                                <?php echo ucfirst(__('app.podcastName')); ?>
                                <span class="badge badge-pill badge-info float-right">
                                    <i class="fas fa-angle-down" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.orderByAsc')); ?>"></i>
                                </span>
                            </th>
                            <th class="text-center"><?php echo ucfirst(__('app.podcastBeganOn')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.podcastEndedOn')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $podcasts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $podcast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($podcast->name); ?></td>
                            <td class="text-center"><?php echo ($podcast->began_on)->format('d/m/Y'); ?></td>
                            <td class="text-center">
                                <?php if($podcast->ended_on): ?>
                                    <?php echo ($podcast->ended_on)->format('d/m/Y'); ?>
                                <?php else: ?>
                                    <?php echo ucfirst(__('app.podcastAiring')); ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo e(route('public.podcast.show', ['uuid' => $podcast->uuid])); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/podcast/index.blade.php ENDPATH**/ ?>