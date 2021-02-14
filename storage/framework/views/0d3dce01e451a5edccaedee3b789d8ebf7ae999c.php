<!-- Modal: modalManufacturerCreate -->
<div class="modal fade" id="modalManufacturerCreate" tabindex="-1" role="dialog" aria-labelledby="modalManufacturerCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.manufacturer.store')); ?>" class="needs-validation" novalidate />
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalManufacturerCreateTitle"><?php echo ucfirst(__('app.manufacturerCreate')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_company">
								<i class="fas fa-industry"></i>
							</span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="company_name" id="company" autocomplete="off" placeholder="<?php echo ucfirst(__('app.company')); ?>" aria-label="<?php echo ucfirst(__('app.company')); ?>" aria-describedby="form_company" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_country"><i class="fas fa-globe"></i></span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="country_name" id="countries" autocomplete="off" placeholder="<?php echo ucfirst(__('app.manufacturerCountry')); ?>" aria-label="<?php echo ucfirst(__('app.manufacturerCountry')); ?>" aria-describedby="form_country" required />
                        <input type="hidden" name="country_uuid" id="country_uuid" value="" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.save')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/manufacturerCreate.blade.php ENDPATH**/ ?>