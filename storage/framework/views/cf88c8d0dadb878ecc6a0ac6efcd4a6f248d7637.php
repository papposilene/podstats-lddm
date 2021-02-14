<!-- Modal: modalProfessionCreate -->
<div class="modal fade" id="modalProfessionCreate" tabindex="-1" role="dialog" aria-labelledby="modalProfessionCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.profession.store')); ?>" class="needs-validation" novalidate />
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProfessionCreateTitle">
                        <?php echo ucfirst(__('app.professionCreate')); ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="profession[1][lang]" value="en" placeholder="<?php echo ucfirst(__('app.language')); ?>" maxlength="2" aria-label="<?php echo ucfirst(__('app.language')); ?>" required />
                        <input type="text" class="form-control border border-primary" name="profession[1][name]" placeholder="<?php echo ucfirst(__('app.profession')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.profession')); ?>" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="profession[2][lang]" value="fr" placeholder="<?php echo ucfirst(__('app.language')); ?>" aria-label="<?php echo ucfirst(__('app.language')); ?>" required />
                        <input type="text" class="form-control border border-primary" name="profession[2][name]" placeholder="<?php echo ucfirst(__('app.profession')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.profession')); ?>" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/professionCreate.blade.php ENDPATH**/ ?>