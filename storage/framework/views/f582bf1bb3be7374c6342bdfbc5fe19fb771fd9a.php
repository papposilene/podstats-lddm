<?php $__env->startSection('title', $manufacturer->company); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <?php echo e($manufacturer->company); ?>

    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalConsoleCreate">
                <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.consoleCreate')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.consoleCreate')); ?></span>
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

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">
                    <?php echo ucfirst(__('app.releasedOn')); ?>
                    <span class="badge badge-pill badge-info float-right">
                        <i class="fas fa-angle-up" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.orderByDesc')); ?>"></i>
                    </span>
                </th>
                <th class="text-center"><?php echo ucfirst(__('app.console')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.type')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.generation')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.games')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $manufacturer->hasConsoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center">
                    <?php echo e($loop->iteration); ?>

                </td>
                <td class="text-center">
                    <?php echo e($console->released_on); ?>

                </td>
                <td><?php echo e($console->name); ?></td>
                <td><?php echo ucfirst(__('app.' . $console->type)); ?></td>
                <td class="text-center"><?php echo e($console->generation); ?></td>
                <td class="text-center"><?php echo e(count($console->hasGames)); ?></td>
                <td class="text-center">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                    <form method="POST" action="<?php echo e(route('admin.console.delete')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="console_uuid" value ="<?php echo e($console->uuid); ?>" />
                        <?php endif; ?>
                        <a href="<?php echo e(route('admin.console.show', ['uuid' => $console->uuid])); ?>" class="btn btn-sm btn-primary">
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.consoleCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$(function() {
    $("#manufacturers").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.manufacturer.autocomplete', ['q']); ?>=" + request.term, function (data) {
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
                            label: value.company,
                            value: value.company
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#manufacturer_uuid").val(ui.item.uuid);
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/manufacturer/show.blade.php ENDPATH**/ ?>