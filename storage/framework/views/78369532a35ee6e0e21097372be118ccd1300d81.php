<!-- Modal: modalSerieGameAdd -->
<div class="modal fade" id="modalSerieGameAdd" tabindex="-1" role="dialog" aria-labelledby="modalSerieGameAddTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.serie.game')); ?>" class="needs-validation" novalidate />
        <?php echo csrf_field(); ?>
        <input type="hidden" name="game_uuid" value="<?php echo e($game->uuid); ?>" required />
        <input type="hidden" name="serie_uuid" id="serie_uuid" value="" required />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSerieGameAddTitle"><?php echo ucfirst(__('app.gameSerieAdd')); ?></h5>
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
                        <input type="text" class="form-control border border-primary" name="serie_name" id="serie_search" placeholder="<?php echo ucfirst(__('app.serieName')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.serieName')); ?>" aria-describedby="serie_name" required />
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/serieGameAdd.blade.php ENDPATH**/ ?>