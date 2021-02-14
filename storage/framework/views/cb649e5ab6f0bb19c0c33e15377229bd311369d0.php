<?php $__env->startSection('title', $user->uname); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <?php echo e($user->uname); ?>

    </h1>
    <?php if($user->hasRole('superAdmin') || ($user->uuid == Auth::user()->uuid)): ?>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalUserUpdate">
                <i class="fas fa-file-import" aria-hidden="true" title="<?php echo ucfirst(__('app.userEdit', ['user' => $user->uname])); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.userEdit', ['user' => $user->uname])); ?></span>
            </button>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if(auth()->check() && auth()->user()->hasRole('superAdmin')): ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3">
    <h3><?php echo ucfirst(__('app.userPermission')); ?></h3>
    <form method="post" action="<?php echo e(route('admin.user.permission')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="user_uuid" value="<?php echo e($user->uuid); ?>" />
        <div class="form-group">
            <label for="formUserPermission">Example select</label>
            <select class="form-control" id="formUserPermission">
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($role->id); ?>" <?php if($user->hasRole($role->name)): ?> selected <?php endif; ?>><?php echo e($role->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
    </form>
</div>

<?php echo e($activities->links()); ?>


<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center"><?php echo ucfirst(__('app.activityLogName')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.menuCreatedAt')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.activityDescription')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.activitySId')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.activitySType')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center"><?php echo e($activity->id); ?></td>
                <td><?php echo e($activity->log_name); ?></td>
                <td><?php echo e($activity->created_at); ?></td>
                <td><?php echo e($activity->description); ?></td>
                <td><?php echo e($activity->subject_id); ?></td>
                <td><?php echo e($activity->subject_type); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
<?php echo $__env->make('modals.userUpdate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/user/show.blade.php ENDPATH**/ ?>