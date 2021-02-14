<?php $__env->startSection('title', @ucfirst(__('app.activityLog'))); ?>

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
                    <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                    <?php echo ucfirst(__('app.activityLog')); ?>
                </h1>
            </div>

			<?php echo e($activities->links()); ?>

			
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo ucfirst(__('app.activityLogName')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.menuCreatedAt')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.activityCId')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.activityCType')); ?></th>
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
                            <td>
                                <a href="<?php echo e(route('admin.user.show', ['uuid' => $activity->causer_id])); ?>" class="text-white">
                                    <?php echo e($activity->causer_id); ?>

                                </a>
                            </td>
                            <td><?php echo e($activity->causer_type); ?></td>
                            <td><?php echo e($activity->description); ?></td>
                            <td><?php echo e($activity->subject_id); ?></td>
                            <td><?php echo e($activity->subject_type); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <?php echo e($activities->links()); ?>

            
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/activity.blade.php ENDPATH**/ ?>