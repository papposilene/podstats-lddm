<?php $__env->startSection('title', @ucfirst(__('app.manufacturersList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <?php echo ucfirst(__('app.manufacturersList')); ?>
    </h1>
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
                <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="<?php echo ucfirst(__('app.search')); ?>" aria-label="<?php echo ucfirst(__('app.search')); ?>">
                <div class="input-group-append">
                    <button type="submit" class="bg-dark border border-secondary btn-sm text-white">
                        <i class="fas fa-search" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.search')); ?>"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php echo e($manufacturers->links()); ?>


<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">
                    <?php echo ucfirst(__('app.company')); ?>
                    <span class="badge badge-pill badge-info float-right">
                        <i class="fas fa-angle-down" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.orderByAsc')); ?>"></i>
                    </span>
                </th>
                <th class="text-center"><?php echo ucfirst(__('app.manufacturerCountry')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.consoles')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
            </tr>
        </thead>
        <?php $__currentLoopData = $manufacturers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tbody>
            <tr>
                <td class="text-center">
                    <?php echo e($loop->iteration); ?>

                </td>
                <td>
                    <?php echo e($manufacturer->company); ?>

                </td>
                <td>
                    <?php echo e($manufacturer->locatedAt->flag); ?>&nbsp;
                    <?php echo e($manufacturer->locatedAt->name_eng_common); ?>

                </td>
                <td class="text-center">
                    <?php echo e(count($manufacturer->hasConsoles)); ?>

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

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.manufacturerCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$( function() {
    $("#countries").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.country.autocomplete', ['q']); ?>=" + request.term, function (data) {
                if(!data.length){
                    var result = [{
                        label: '<?php echo ucfirst(__('app.searchNotFound')); ?>',
                        value: response.term
                    }];
                    response(result);
                }
                else
                {
                    response($.map(data, function (value, key) {
                        return {
                            uuid: value.uuid,
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
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
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/manufacturer/admin.blade.php ENDPATH**/ ?>