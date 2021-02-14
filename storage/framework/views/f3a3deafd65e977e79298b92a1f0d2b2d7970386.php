<?php $__env->startSection('title', $console->name); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <div class="row">
        <main role="main" class="col-12">
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
                    <?php echo e($console->name); ?>

                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalConsoleUpdate">
                            <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.consoleUpdate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.consoleUpdate')); ?></span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('admin.console.search')); ?>" method="POST">
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
                
            <div class="row">
                <div class="col-8">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        <?php echo ucfirst(__('app.gameTitle')); ?>
                                        <span class="badge badge-pill badge-info float-right">
                                            <i class="fas fa-angle-down" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.orderByAsc')); ?>"></i>
                                        </span>
                                    </th>
                                    <th class="text-center"><?php echo ucfirst(__('app.gameDate')); ?></th>
                                    <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $console->hasGames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <?php echo e($game->hasGame->title); ?>

                                    </td>
                                    <td class="text-center">
                                        <?php if($game->hasGame->released_on): ?>
                                        <?php echo ($game->hasGame->released_on)->format('d/m/Y'); ?>
                                        <?php else: ?>
                                        00/00/0000
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                        <form method="POST" action="<?php echo e(route('admin.unlink.game')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="relation_uuid" value ="<?php echo e($game->uuid); ?>" />
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('admin.game.show', ['uuid' => $game->uuid])); ?>" class="btn btn-sm btn-primary">
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
                </div>
                
                <div class="col-4">
                    <div class="card mb-4">
                        <h5 class="card-header">
                            <?php echo e($console->name); ?>

                        </h5>
                        <ul class="list-group list-group-flush">
                            <a href="<?php echo e(route('admin.manufacturer.show', ['uuid' => $console->manufacturer_uuid])); ?>"  class="list-group-item list-group-item-action">
                                <?php echo e($console->byManufacturer->company); ?>

                                <span class="float-right"><?php echo e($console->byManufacturer->locatedAt->flag); ?></span>
                            </a>
                            <li class="list-group-item text-justify">
                                <i class="fas fa-calendar-check" aria-hidden="true" title="<?php echo ucfirst(__('app.gameDate')); ?>"></i>
                                <?php if($console->released_on): ?>
                                &nbsp;<?php echo e($console->released_on); ?>

                                <?php else: ?>
                                &nbsp;0000
                                <?php endif; ?>
                            </li>
                            <li class="list-group-item text-justify">
                                <i class="fas fa-hashtag" aria-hidden="true" title="<?php echo ucfirst(__('app.consoleGeneration')); ?>"></i>
                                <?php if($console->generation): ?>
                                &nbsp;<?php echo e($console->generation); ?>

                                <?php else: ?>
                                &nbsp;---
                                <?php endif; ?>
                            </li>
                            <li class="list-group-item text-justify">
                                <i class="fas fa-laptop-house" aria-hidden="true" title="<?php echo ucfirst(__('app.consoleType')); ?>"></i>
                                &nbsp;<?php echo ucfirst(__('app.' . $console->type)); ?>
                            </li>
                        </ul>
                        <div class="card-footer text-right">
                            <small class="text-muted"><?php echo ($console->updated_at)->format('d/m/Y H:i'); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
<?php echo $__env->make('modals.consoleUpdate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$(function() {
    $("#manufacturers").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.manufacturer.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.company,
                        value: value.company
                    };
                }));
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/console/show.blade.php ENDPATH**/ ?>