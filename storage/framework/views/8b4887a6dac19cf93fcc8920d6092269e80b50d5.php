<?php $__env->startSection('title', @ucfirst(__('app.manufacturersList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?php if($errors->any()): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <div class="col alert alert-danger">
                    <ol>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="text-danger"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-industry" aria-hidden="true"></i>
                    <?php echo ucfirst(__('app.manufacturersList')); ?>
                </h1>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                <div class="btn-toolbar mb-2 mb-md-0">
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalManufacturerCreate">
                            <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.manufacturerCreate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.manufacturerCreate')); ?></span>
                        </button>
                    </div>
					<?php endif; ?>
                    <form action="<?php echo e(route('admin.manufacturer.search')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="<?php echo ucfirst(__('app.search')); ?>" aria-label="<?php echo ucfirst(__('app.search')); ?>" aria-describedby="form_search">
							<div class="input-group-append">
                                <button type="submit" class="bg-dark border border-secondary text-white" id="form_search">
                                    <i class="fas fa-search" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.search')); ?>"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
			
			<?php echo e($manufacturers->links()); ?>

            
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th><?php echo ucfirst(__('app.company')); ?></th>
                            <th><?php echo ucfirst(__('app.manufacturerCountry')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.consoles')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.studios')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
					<?php $__currentLoopData = $manufacturers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tbody>
                        <tr>
                            <td class="text-center">#</td>
                            <td><?php echo e($manufacturer->company); ?></td>
                            <td>
								<?php echo e($manufacturer->locatedAt->flag); ?>&nbsp;
								<?php echo e($manufacturer->locatedAt->name_eng_common); ?>

							</td>
                            <td class="text-center">
								<?php echo e(count($manufacturer->consoles)); ?>

							</td>
                            <td class="text-center">
								
							</td>
                            <td class="text-center">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                <form method="POST" action="<?php echo e(route('admin.manufacturer.delete')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="manufacturer_uuid" value ="<?php echo e($manufacturer->uuid); ?>" />
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('admin.manufacturer.show', ['uuid' => $manufacturer->uuid])); ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.show')); ?>"></i>
                                    </a>
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                                    <a href="<?php echo e(route('admin.manufacturer.edit', ['uuid' => $manufacturer->uuid])); ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.edit')); ?>"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.delete')); ?>"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
							</td>
                        </tr>
                    </tbody>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
			
			<?php echo e($manufacturers->links()); ?>

			
        </main>
    </div>
</div>

<!-- Modal: modalManufacturerCreate -->
<div class="modal fade" id="modalManufacturerCreate" tabindex="-1" role="dialog" aria-labelledby="modalManufacturerCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.manufacturer.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalManufacturerCreateTitle"><?php echo ucfirst(__('app.manufacturerCreate')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_company">
								<i class="fas fa-industry"></i>
							</span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="company_name" id="company" autocomplete="off" placeholder="<?php echo ucfirst(__('app.company')); ?>" aria-label="<?php echo ucfirst(__('app.company')); ?>" aria-describedby="form_company">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_country"><i class="fas fa-globe"></i></span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="country_name" id="countries" autocomplete="off" placeholder="<?php echo ucfirst(__('app.manufacturerCountry')); ?>" aria-label="<?php echo ucfirst(__('app.manufacturerCountry')); ?>" aria-describedby="form_country">
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
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$( function() {
    $("#countries").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.country.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        cca3: value.cca3,
                        label: value.name_eng_common,
                        value: value.name_eng_common
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#country_uuid").val(ui.item.uuid);
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/manufacturer/admin.blade.php ENDPATH**/ ?>