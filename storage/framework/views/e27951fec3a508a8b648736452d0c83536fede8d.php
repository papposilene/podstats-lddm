<!-- Modal: modalStaffAdd -->
<div class="modal fade" id="modalStaffAdd" tabindex="-1" role="dialog" aria-labelledby="modalStaffAddTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.contact.staff')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="podcast_uuid" id="podcast_uuid" value="<?php echo e($episode->podcast_uuid); ?>" />
        <input type="hidden" name="episode_uuid" id="episode_uuid" value="<?php echo e($episode->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalStaffAddTitle">
						<?php echo ucfirst(__('app.staffCreate')); ?>
					</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_profession"><i class="fas fa-user-tie"></i></span>
                        </div>
                        <select class="form-control border border-primary" name="profession_uuid">
                            <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_contact"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="contact_uname" id="contact_search" placeholder="<?php echo ucfirst(__('app.contact')); ?>" aria-label="<?php echo ucfirst(__('app.contact')); ?>">
                    </div>
                </div>
                <input type="hidden" name="contact_uuid" id="contact_uuid" value="" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.staffStore')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/modals/staffCreate.blade.php ENDPATH**/ ?>