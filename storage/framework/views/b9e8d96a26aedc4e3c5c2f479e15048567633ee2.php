<!-- Modal: modalSourceTypeCreate -->
<div class="modal fade" id="modalSourceTypeCreate" tabindex="-1" role="dialog" aria-labelledby="modalSourceTypeCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.source.type')); ?>" class="needs-validation" novalidate />
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSourceTypeCreateTitle">
                        <?php echo ucfirst(__('app.sourceTypeCreate')); ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-icons" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="source_icon" placeholder="<?php echo e(__('app.sourceIcons')); ?>" autocomplete="off" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-link" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="source_type" placeholder="<?php echo ucfirst(__('app.source')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.source')); ?>" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/sourceTypeCreate.blade.php ENDPATH**/ ?>