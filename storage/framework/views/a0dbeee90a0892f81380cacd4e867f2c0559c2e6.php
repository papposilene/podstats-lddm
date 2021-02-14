<?php $__env->startSection('title', @ucfirst(__('app.usersList'))); ?>

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
                    <i class="fas fa-users" aria-hidden="true"></i>
                    <?php echo ucfirst(__('app.usersList')); ?>
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalUserInvite">
                        <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.userInvite')); ?>"></i>
                        <span><?php echo ucfirst(__('app.userInvite')); ?></span>
                    </button>
                </div>
            </div>
            
            <?php echo e($users->links()); ?>

                
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo ucfirst(__('app.uname')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.role')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($user->uname); ?></td>
                            <td><?php echo e($user->roles->name); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.user.show', ['uuid' => $user->uuid])); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.userLook', ['user' => $user->uname])); ?>"></i>
                                    <span class="sr-only"><?php echo ucfirst(__('app.userLook', ['user' => $user->uname])); ?></span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Modal: modalUserInvite -->
<div class="modal fade" id="modalUserInvite" tabindex="-1" role="dialog" aria-labelledby="modalUserInviteTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.invite.process')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserInviteTitle"><?php echo ucfirst(__('app.userInvite')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text bg-primary border border-primary text-white" id="invite-email">
								<i class="fas fa-at" aria-hidden="true" title="<?php echo ucfirst(__('app.userInvite')); ?>"></i>
							</span>
						</div>
						<input type="text" class="form-control border border-primary" name="email" autocomplete="off" placeholder="<?php echo ucfirst(__('app.email')); ?>" aria-label="<?php echo ucfirst(__('app.email')); ?>" aria-describedby="invite-email">
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.userInvited')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/user/index.blade.php ENDPATH**/ ?>