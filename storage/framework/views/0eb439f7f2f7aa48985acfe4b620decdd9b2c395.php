<!-- Modal: modalSerieCreate -->
<div class="modal fade" id="modalSerieCreate" tabindex="-1" role="dialog" aria-labelledby="modalSerieCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.serie.store')); ?>" class="needs-validation" novalidate />
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSerieCreateTitle"><?php echo ucfirst(__('app.serieCreate')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="serie_name">
								<i class="fas fa-stream" aria-hidden="true"></i>
							</span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="serie_name" placeholder="<?php echo ucfirst(__('app.serieName')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.serieName')); ?>" aria-describedby="serie_name" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/serieCreate.blade.php ENDPATH**/ ?>