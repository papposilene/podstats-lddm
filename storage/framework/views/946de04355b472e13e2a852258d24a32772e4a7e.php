<?php $__env->startSection('title', @ucfirst(__('app.episodesList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
        <?php echo ucfirst(__('app.episodesList')); ?>
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEpisodeCreate">
                <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.episodeCreate')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.episodeCreate')); ?></span>
            </button>
        </div>
        <?php endif; ?>
        <form action="<?php echo e(route('admin.episode.index')); ?>" method="POST">
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

<?php echo e($episodes->links()); ?>


<div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo ucfirst(__('app.podcast')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeId')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.season')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeTitle')); ?></th>
                            <th class="text-center">
                                <?php echo ucfirst(__('app.episodeAiredOn')); ?>
                                <span class="badge badge-pill badge-info float-right">
                                    <i class="fas fa-angle-up" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.orderByDesc')); ?>"></i>
                                </span>
                            </th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeDuration')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeStaff')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeTracks')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $episodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.podcast.show', ['uuid' => $episode->podcast_uuid])); ?>" class="text-white">
                                    <?php echo e($episode->inPodcast->name); ?>

                                </a>
                            </td>
                            <td class="text-center"><?php echo e($episode->id); ?></td>
                            <td class="text-center"><?php echo e($episode->season); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.episode.show', ['uuid' => $episode->uuid])); ?>" class="text-white">
                                    <?php echo e($episode->title); ?>

                                </a>
                            </td>
                            <td class="text-center">
                                <?php if($episode->aired_on): ?>
                                <?php echo ($episode->aired_on)->format('d/m/Y'); ?>
                                <?php else: ?>
                                00/00/0000
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($episode->duration): ?>
                                <?php echo ($episode->duration)->format('H:i:s'); ?>
                                <?php else: ?>
                                00:00:00
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo e(count($episode->hasContacts)); ?></td>
                            <td class="text-center"><?php echo e(count($episode->hasTracklist)); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.episode.show', ['uuid' => $episode->uuid])); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.showData')); ?>"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <?php echo e($episodes->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/episode/admin.blade.php ENDPATH**/ ?>