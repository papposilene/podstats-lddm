<?php $__env->startSection('title', @ucfirst(__('app.studiosList'))); ?>

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
                    <i class="fas fa-terminal" aria-hidden="true"></i>
                    <?php echo ucfirst(__('app.studiosList')); ?>
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
					<div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalStudioCreate">
                            <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.studioCreate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.studioCreate')); ?></span>
                        </button>
                    </div>
					<?php endif; ?>
					<form action="<?php echo e(route('admin.studio.search')); ?>" method="POST">
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
                            <th class="text-center"><?php echo ucfirst(__('app.studio')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.country')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.games')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $studios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($studio->studio); ?></td>
                            <td>
                                <?php echo e($studio->locatedAt->flag); ?>

                                <?php echo e($studio->locatedAt->name_eng_common); ?>

                            </td>
                            <td class="text-center"><?php echo e(count($studio->games)); ?></td>
                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                <form method="POST" action="<?php echo e(route('admin.studio.delete')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="studio_uuid" value ="<?php echo e($studio->uuid); ?>" />
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('admin.studio.show', ['uuid' => $studio->uuid])); ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.search')); ?>"></i>
                                    </a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash" aria-hidden="true" title="<?php echo ucfirst(__('app.delete')); ?>"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.studioCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
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
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/studio/admin.blade.php ENDPATH**/ ?>