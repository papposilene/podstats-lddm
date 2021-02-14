<!-- Modal: modalSourceCreate -->
<div class="modal fade" id="modalSourceCreate" tabindex="-1" role="dialog" aria-labelledby="modalSourceCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.source.store')); ?>" class="needs-validation" novalidate />
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSourceCreateTitle">
                        <?php echo ucfirst(__('app.sourceCreate')); ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" value="<?php echo e($contact->uname); ?>" disabled="disabled" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-link" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="source_data" placeholder="<?php echo e(__('app.http')); ?>" autocomplete="off" autofocus="1" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                            </span>
                        </div>
                        <select type="text" class="form-control border border-primary" name="source_type" required />
                        <?php $__currentLoopData = $listSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($source->type); ?>"><?php echo ucfirst(__('app.' . $source->type)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="item_model" value="contact" required />
                <input type="hidden" name="item_uuid" id="item_uuid" value="<?php echo e($contact->uuid); ?>" required />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/sourceContactCreate.blade.php ENDPATH**/ ?>