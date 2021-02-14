<?php $__env->startSection('title', @ucfirst(__('app.contactShow'))); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom">
                <h1 class="h2"><?php echo e($contact->uname); ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                    <div class="btn-group mr-2">
                        <a href="<?php echo e(route('admin.contact.edit', ['uuid' => $contact->uuid])); ?>" class="btn btn-sm btn-primary" role="button">
                            <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.contactUpdate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.contactUpdate')); ?></span>
                        </a>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('admin.contact.search')); ?>" method="POST">
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
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3">
                <div>
                    <p class="text-justify">
                        <?php echo e($contact->biography); ?>

                    </p>
                </div>
            </div>
                
            <h2 class="text-white">
                <?php echo ucfirst(__('app.podcastsList')); ?>
                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalPodcast">
                    <?php echo ucfirst(__('app.podcastLink')); ?>
                </button>
            </h2>
                
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo ucfirst(__('app.podcastName')); ?></th>
                            <th><?php echo ucfirst(__('app.profession')); ?></th>
                            <th><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contact->worksAsInEpisode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($loop->iteration); ?></th>
                            <td><?php echo e($staff->profession); ?></td>
                            <td><?php echo e($staff->profession); ?></td>
                            <td>
                                
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPodcast" tabindex="-1" role="dialog" aria-labelledby="modalPodcastTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.contact.staff')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="contact_uuid" id="contact_uuid" value="<?php echo e($contact->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPodcastTitle"><?php echo ucfirst(__('app.contactAddPodcast', ['contact' => $contact->uname])); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="form_name">&nbsp;<i class="fas fa-podcast"></i></span>
                        </div>
                        <input type="text" class="form-control" name="podcast_name" id="podcasts" autocomplete="off" placeholder="<?php echo ucfirst(__('app.podcastName')); ?>" aria-label="<?php echo ucfirst(__('app.podcastName')); ?>" aria-describedby="form_name">
                        <input type="hidden" name="podcast_uuid" id="podcast_uuid" value="" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="form_profession"><i class="fas fa-users-cog"></i></span>
                        </div>
                        <select class="form-control" name="profession_uuid">
                            <option value="" selected><?php echo ucfirst(__('app.professionsList')); ?></option>
                            <?php $__currentLoopData = $listProfessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listProfession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($listProfession->uuid); ?>"><?php echo ucfirst(__('app.' . $listProfession->profession)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.podcastLink')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$( function() {
    $("#podcasts").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.podcast.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        label: value.name,
                        value: value.name,
                        uuid: value.uuid
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#podcast_uuid").val(ui.item.uuid);
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/contact/show.blade.php ENDPATH**/ ?>