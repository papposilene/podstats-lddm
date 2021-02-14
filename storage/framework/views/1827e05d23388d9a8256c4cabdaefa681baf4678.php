<!-- Modal: modalRelationEpisodeCreate -->
<div class="modal fade" id="modalRelationEpisodeCreate" tabindex="-1" role="dialog" aria-labelledby="modalRelationEpisodeCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.link.episode')); ?>" class="needs-validation" novalidate />
        <?php echo csrf_field(); ?>
        <input type="hidden" name="podcast_uuid" id="podcast_uuid" value="<?php echo e($episode->podcast_uuid); ?>" />
        <input type="hidden" name="episode_uuid" id="episode_uuid" value="<?php echo e($episode->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRelationEpisodeCreateTitle">
						<?php echo ucfirst(__('app.staffCreate')); ?>
					</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_profession">
                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                            </span>
                        </div>
                        <select class="form-control border border-primary" name="profession_uuid" required />
                            <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_contact">
                                <i class="fas fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="staff_uname" id="staff_search" placeholder="<?php echo ucfirst(__('app.contact')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.contact')); ?>" required />
                    </div>
                </div>
                <input type="hidden" name="staff_uuid" id="staff_uuid" value="" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/relationEpisodeCreate.blade.php ENDPATH**/ ?>