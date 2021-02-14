<?php $__env->startSection('title', @ucfirst(__('app.sourcesList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <?php echo ucfirst(__('app.sourcesList')); ?>
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalSourceTypeCreate">
                <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.sourceTypeCreate')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.sourceTypeCreate')); ?></span>
            </button>
        </div>
        <?php endif; ?>
        <form action="<?php echo e(route('admin.source.search')); ?>" method="POST">
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

<?php echo e($sources->links()); ?>


<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center"><?php echo ucfirst(__('app.sourceItem')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.sourceType')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.sourceData')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
            </tr>
        </thead>
        <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tbody>
            <tr>
                <td class="text-center">
                    <?php echo e($loop->iteration); ?>

                </td>
                <td>
                    <?php if($source->item_model === 'contact'): ?>
                    <a href="<?php echo e(route('admin.contact.show', ['uuid' => $source->item_uuid])); ?>" class="text-white">
                        <?php echo e($source->item_uuid); ?>

                    </a>
                    <?php elseif($source->item_model === 'podcast'): ?>
                    <a href="<?php echo e(route('admin.podcast.show', ['uuid' => $source->item_uuid])); ?>" class="text-white">
                        <?php echo e($source->item_uuid); ?>

                    </a>
                    <?php elseif($source->item_model === 'episode'): ?>
                    <a href="<?php echo e(route('admin.episode.show', ['uuid' => $source->item_uuid])); ?>" class="text-white">
                        <?php echo e($source->item_uuid); ?>

                    </a>
                    <?php elseif($source->item_model === 'track'): ?>
                    <a href="<?php echo e(route('admin.track.show', ['uuid' => $source->item_uuid])); ?>" class="text-white">
                        <?php echo e($source->item_uuid); ?>

                    </a>
                    <?php else: ?>
                    <?php echo e($source->item_uuid); ?>

                    <?php endif; ?>
                </td>
                <td>
                    <i class="<?php echo e($source->info->icon); ?>" aria-hidden="true" title="<?php echo ucfirst(__('app.' . $source->type)); ?>"></i>
                    <?php echo ucfirst(__('app.' . $source->type)); ?>
                </td>
                <td>
                    <a href="<?php echo e($source->data); ?>" class="text-white" target="_blank" rel="noopener">
                        <?php echo e($source->data); ?>

                    </a>
                </td>
                <td class="text-center">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                    <form method="POST" action="<?php echo e(route('admin.source.delete')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="source_uuid" value ="<?php echo e($source->uuid); ?>" />
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.delete')); ?>"></i>
                        </button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>

<?php echo e($sources->links()); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.sourceTypeCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/source/admin.blade.php ENDPATH**/ ?>