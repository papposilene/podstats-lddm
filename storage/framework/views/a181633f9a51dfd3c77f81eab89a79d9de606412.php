<?php $__env->startSection('title', @ucfirst(__('app.trackEdit', ['track' => $track->title]))); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-8">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-white">
                <?php echo e($track->title); ?>

            </h1>
        </div>

        <form method="POST" action="<?php echo e(route('admin.track.update')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="contact_uuid" value="<?php echo e($track->uuid); ?>" />

            <button type="submit" class="btn btn-primary mt-3 float-right"><?php echo ucfirst(__('app.trackUpdate')); ?></button>
        </form>
    </div>
    <div class="col-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h2 class="h2 text-white">
                <i class="fas fa-list-ol" aria-hidden="true" title="<?php echo ucfirst(__('app.dataLast')); ?>"></i>
                <?php echo ucfirst(__('app.dataLast')); ?>
            </h2>
        </div>

        <?php if(count($track->hasArtists) > 0): ?>
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $track->hasArtists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.contact.show', ['uuid' => $artist->composedBy->uuid])); ?>" class="list-group-item list-group-item-action">
                <?php echo e($artist->composedBy->uname); ?>

            </a>
            <?php if($loop->iteration == 5) break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/track/edit.blade.php ENDPATH**/ ?>