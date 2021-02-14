<?php $__env->startSection('title', $episode->podcast->name . ' : ' . $episode->title); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?php if($errors->any()): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4">
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
                    <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
                    <?php echo e($episode->title); ?>

                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEpisodeEdit">
                            <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.episodeEdit', ['episode' => $episode->title])); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.episodeCreate')); ?></span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('admin.episode.index')); ?>" method="POST">
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
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-podcast" aria-hidden="true"></i>
                                <a href="<?php echo e(route('admin.podcast.show', ['uuid' => $episode->podcast_uuid])); ?>" class="text-white">
                                    <?php echo e($episode->podcast->name); ?>

                                </a>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-list-ol" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.seasonNb', ['season' => $episode->season])); ?>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-hashtag" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.episodeNb', ['episode' => $episode->id])); ?>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-calendar-check" aria-hidden="true"></i>
                                <?php echo ($episode->aired_on)->format('d/m/Y'); ?>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-clock" aria-hidden="true"></i>
                                <?php echo ($episode->duration)->format('H:i:s'); ?>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-link" aria-hidden="true"></i>
                                <?php if($episode->linkedTo): ?>
                                <a href="<?php echo e($episode->linkedTo->data); ?>" class="text-white" target="_blank" rel="noopener">
                                    <?php echo ucfirst(__('app.episodeSource')); ?>
                                </a>
                                <?php else: ?>
                                ---
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-white text-justify">
                                <?php echo e($episode->description); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-8">
                    <h2 class="h4 text-white pt-3 pb-2 border-bottom">
                        <i class="fas fa-users" aria-hidden="true"></i>
                        <?php echo ucfirst(__('app.tracksList')); ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                        <div class="btn-group mr-2 float-right">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTrackCreate">
                                <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.trackCreate')); ?>"></i>
                                <span class="sr-only"><?php echo ucfirst(__('app.trackCreate')); ?></span>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalTracklistImport">
                                <i class="fas fa-file-import" aria-hidden="true" title="<?php echo ucfirst(__('app.trackImport')); ?>"></i>
                                <span class="sr-only"><?php echo ucfirst(__('app.trackImport')); ?></span>
                            </button>
                        </div>
                        <?php endif; ?>
                    </h2>
                        
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center"><?php echo ucfirst(__('app.trackAuthor')); ?></th>
                                    <th class="text-center"><?php echo ucfirst(__('app.trackTitle')); ?></th>
                                    <th class="text-center"><?php echo ucfirst(__('app.gameTitle')); ?></th>
                                    <th class="text-center"><?php echo ucfirst(__('app.trackDate')); ?></th>
                                    <th class="text-center"><?php echo ucfirst(__('app.trackDuration')); ?></th>
                                    <th class="text-center"><?php echo ucfirst(__('app.trackType')); ?></th>
                                    <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $episode->tracklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $track->artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('admin.contact.show', ['uuid' => $artist->uuid])); ?>" class="text-white">
                                            <?php echo e($artist->uname); ?>

                                        </a><br />
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <?php echo e($track->title); ?>

                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.game.show', ['uuid' => $track->game->uuid])); ?>" class="text-white">
                                            <?php echo e($track->game->title); ?>

                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?php echo e($track->released_on); ?>

                                    </td>
                                    <td class="text-center">
                                        <?php echo e($track->duration); ?>

                                    </td>
                                    <td>
                                        <?php echo ucfirst(__('app.' . $episode->trackinfo->track_type)); ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('admin.game.show', ['uuid' => $track->game->uuid])); ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-gamepad" aria-hidden="true"></i>
                                        </a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                                        <a href="<?php echo e(route('admin.track.edit', ['uuid' => $track->uuid])); ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-4">
                <h2 class="h4 text-white pt-3 pb-2 border-bottom">
                    <i class="fas fa-users" aria-hidden="true"></i>
                    <?php echo ucfirst(__('app.staffList')); ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                    <div class="btn-group mr-2 float-right">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalStaffAdd">
                            <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.staffCreate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.staffCreate')); ?></span>
                        </button>
                    </div>
                    <?php endif; ?>
                </h2>
                    
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo ucfirst(__('app.uname')); ?></th>
                                <th class="text-center"><?php echo ucfirst(__('app.profession')); ?></th>
                                <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $episode->staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($team->uname); ?></td>
                                <td><?php echo e($team->worksAsInEpisode->profession); ?></td>
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                    <form method="POST" action="<?php echo e(route('admin.unstaff')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="staff_uuid" value ="<?php echo e($team->uuid); ?>" />
											<input type="hidden" name="relationship" value="episode" />
											<?php endif; ?>
											<a href="<?php echo e(route('admin.contact.show', ['uuid' => $team->uuid])); ?>" class="btn btn-sm btn-primary">
												<i class="fas fa-search" aria-hidden="true"></i>
											</a>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
											<a href="<?php echo e(route('admin.contact.edit', ['uuid' => $team->uuid])); ?>" class="btn btn-sm btn-info">
												<i class="fas fa-edit" aria-hidden="true"></i>
											</a>
											<?php endif; ?>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
											<button class="btn btn-sm btn-danger">
												<i class="fas fa-trash" aria-hidden="true"></i>
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
        </main>
    </div>
</div>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<!-- Modal: modalEpisodeEdit -->
<div class="modal fade" id="modalEpisodeEdit" tabindex="-1" role="dialog" aria-labelledby="modalEpisodeEditTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.episode.update')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="podcast_uuid" value="<?php echo e($episode->podcast->uuid); ?>" />
        <input type="hidden" name="episode_uuid" value="<?php echo e($episode->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEpisodeEditTitle"><?php echo ucfirst(__('app.episodeUpdate')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_sid">
                                        <i class="fas fa-hashtag" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="season_id" value="<?php echo e($episode->season); ?>" aria-label="<?php echo ucfirst(__('app.seasonId')); ?>" aria-describedby="form_sid">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_eid">
                                        <i class="fas fa-hashtag" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="episode_id" value="<?php echo e($episode->id); ?>" aria-label="<?php echo ucfirst(__('app.episodeId')); ?>" aria-describedby="form_eid">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_title">
                                <i class="fas fa-file-medical-alt" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="episode_title" value="<?php echo e($episode->title); ?>" aria-label="<?php echo ucfirst(__('app.episodeTitle')); ?>" aria-describedby="form_title">
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_duration">
                                        <i class="fas fa-clock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="episode_duration" value="<?php echo e($episode->duration->format('H:i:s')); ?>" aria-label="<?php echo e(__('app.hhmmss')); ?>" aria-describedby="form_duration">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_airedOn">
                                        <i class="fas fa-calendar-check"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="episode_airedOn" value="<?php echo e($episode->aired_on->format('Y-m-d')); ?>" aria-label="<?php echo e(__('app.ddmmyy')); ?>" aria-describedby="form_airedOn">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_description">
                                <i class="fas fa-audio-description" aria-hidden="true"></i>
                            </span>
                        </div>
                        <textarea class="form-control border border-secondary" rows="7" name="episode_description" aria-label="<?php echo ucfirst(__('app.episodeDescription')); ?>" aria-describedby="form_description"><?php echo e($episode->description); ?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_source">
                                <i class="fas fa-link" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="episode_source" value="<?php if($episode->linkedTo): ?><?php echo e($episode->linkedTo->data); ?><?php endif; ?>" aria-label="<?php echo ucfirst(__('app.episodeSource')); ?>" aria-describedby="form_source">
                        <input type="hidden" name="source_uuid" value="<?php if($episode->linkedTo): ?><?php echo e($episode->linkedTo->uuid); ?><?php endif; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right"><?php echo ucfirst(__('app.episodeStore')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>

<!-- Modal: modalTracklistImport -->
<div class="modal fade" id="modalTracklistImport" tabindex="-1" role="dialog" aria-labelledby="modalTrackImportTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.track.import')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="podcast_uuid" id="podcast_uuid" value="<?php echo e($episode->podcast_uuid); ?>" />
        <input type="hidden" name="episode_uuid" id="episode_uuid" value="<?php echo e($episode->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTrackImportTitle">
						<?php echo ucfirst(__('app.trackImport')); ?>
					</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="importFile"><i class="fas fa-file-import"></i></span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="importedFile" class="custom-file-input border border-primary" id="importFile" aria-describedby="importFile" />
                            <label class="custom-file-label border border-primary" for="importFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.trackImport')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.trackCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modals.staffCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$( function() {
    $("#contact_search").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.uname,
                        value: value.uname
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contact_uuid").val(ui.item.uuid);
		}
	});
    $("#studio_search").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.studio.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.studio,
                        value: value.studio
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#studio_uuid").val(ui.item.uuid);
		}
	});
    $("#game_search").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.game.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.title,
                        value: value.title
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#game_uuid").val(ui.item.uuid);
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/episode/show.blade.php ENDPATH**/ ?>