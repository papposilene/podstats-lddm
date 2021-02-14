<!-- Modal: modalSerieGameCreate -->
<div class="modal fade" id="modalSerieGameCreate" tabindex="-1" role="dialog" aria-labelledby="modalSerieGameCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.serie.add')); ?>" class="needs-validation" novalidate />
        <?php echo csrf_field(); ?>
        <input type="hidden" name="serie_uuid" value="<?php echo e($serie->uuid); ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSerieGameCreateTitle"><?php echo ucfirst(__('app.serieCreate')); ?></h5>
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
                        <input type="text" class="form-control border border-primary" value="<?php echo e($serie->serie); ?>" aria-describedby="serie_name" disabled="disabled" />
                    </div>
                    <div class="form-row">
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-secondary text-white" id="game_order">
                                        <i class="fas fa-hashtag" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="game_order" value="<?php echo e((count($serie->hasGames) + 1)); ?>" placeholder="<?php echo ucfirst(__('app.serieOrder')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.serieOrder')); ?>" aria-describedby="game_order" required />
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-secondary text-white" id="game_title">
                                        <i class="fas fa-gamepad" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="game_title" placeholder="<?php echo ucfirst(__('app.gameTitle')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.gameTitle')); ?>" aria-describedby="game_title" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/serieGameCreate.blade.php ENDPATH**/ ?>