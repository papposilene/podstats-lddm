<!-- Modal: modalStudioCreate -->
<div class="modal fade" id="modalStudioCreate" tabindex="-1" role="dialog" aria-labelledby="modalStudioCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.studio.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalStudioCreateTitle"><?php echo ucfirst(__('app.studioCreate')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_studio">
								<i class="fas fa-terminal"></i>
							</span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="studio_name" autocomplete="off" placeholder="<?php echo ucfirst(__('app.studioName')); ?>" aria-label="<?php echo ucfirst(__('app.studioName')); ?>" aria-describedby="form_studio">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_country"><i class="fas fa-globe"></i></span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="country_name" id="countries" autocomplete="off" placeholder="<?php echo ucfirst(__('app.studioCountry')); ?>" aria-label="<?php echo ucfirst(__('app.studioCountry')); ?>" aria-describedby="form_country">
                        <input type="hidden" name="country_uuid" id="country_uuid" value="" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/modals/studioCreate.blade.php ENDPATH**/ ?>