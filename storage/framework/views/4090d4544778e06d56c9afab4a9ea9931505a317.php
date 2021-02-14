<!-- Modal: modalConsoleUpdate -->
<div class="modal fade" id="modalConsoleUpdate" tabindex="-1" role="dialog" aria-labelledby="modalConsoleUpdateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.console.update')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="console_uuid" value="<?php echo e($console->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConsoleUpdateTitle">
                        <?php echo ucfirst(__('app.consoleUpdate')); ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_console">
								<i class="fas fa-dice" aria-hidden="true"></i>
							</span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="console_name" value="<?php echo e($console->name); ?>" placeholder="<?php echo ucfirst(__('app.console')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.console')); ?>" aria-describedby="form_console">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_manufacturer">
                                &nbsp;<i class="fas fa-industry" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="manufacturer_name" id="manufacturers" value="<?php echo e($console->byManufacturer->company); ?>" placeholder="<?php echo ucfirst(__('app.company')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.company')); ?>" aria-describedby="form_manufacturer">
                        <input type="hidden" name="manufacturer_uuid" id="manufacturer_uuid" value="<?php echo e($console->manufacturer_uuid); ?>" />
                    </div>
                    <div class="form-row">
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_type">
                                        <i class="fas fa-laptop-house" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <select class="form-control border border-primary" name="console_type" aria-describedby="form_type">
                                    <option value="arcade" <?php if($console->type === 'arcade'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.arcade')); ?></option>
                                    <option value="handheld" <?php if($console->type === 'handheld'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.handheld')); ?></option>
                                    <option value="home" <?php if($console->type === 'home'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.home')); ?></option>
                                    <option value="micro" <?php if($console->type === 'micro'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.micro')); ?></option>
                                    <option value="computer" <?php if($console->type === 'computer'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.computer')); ?></option>
                                    <option value="hybrid" <?php if($console->type === 'hybrid'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.hybrid')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border border-secondary text-white" id="form_generation">
                                        <i class="fas fa-hashtag" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-secondary" name="console_generation" value="<?php echo e($console->generation); ?>" placeholder="<?php echo ucfirst(__('app.generation')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.generation')); ?>" aria-describedby="form_generation">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border border-secondary text-white" id="form_releasedOn">
                                        <i class="fas fa-calendar-check" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-secondary" name="console_releasedOn" value="<?php echo e($console->released_on); ?>" placeholder="1970" autocomplete="off" aria-label="<?php echo ucfirst(__('app.releasedOn')); ?>" aria-describedby="form_releasedOn">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.consoleUpdate')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/consoleUpdate.blade.php ENDPATH**/ ?>