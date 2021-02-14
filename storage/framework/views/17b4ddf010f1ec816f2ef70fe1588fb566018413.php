<?php $__env->startSection('title', $episode->inPodcast->name . ' : ' . $episode->title); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
        <?php echo e($episode->title); ?>

    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalContactsList">
                <i class="fas fa-users" aria-hidden="true" title="<?php echo ucfirst(__('app.contactsList')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.contactsList')); ?></span>
            </button>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalRelationEpisodeCreate">
                <i class="fas fa-user-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.episodeEdit', ['episode' => $episode->title])); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.episodeCreate')); ?></span>
            </button>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEpisodeEdit">
                <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.episodeEdit', ['episode' => $episode->title])); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.episodeCreate')); ?></span>
            </button>
            <?php endif; ?>
            <a href="<?php echo e(route('public.episode.show', ['uuid' => $episode->uuid])); ?>" role="button" class="btn btn-sm btn-info" target="_blank">
                <i class="fas fa-external-link-alt" aria-hidden="true"></i>
            </a>
        </div>
        
        <form action="<?php echo e(route('admin.episode.search')); ?>" method="POST">
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
                        <?php echo e($episode->inPodcast->name); ?>

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
                    <?php if($episode->aired_on): ?>
                    <?php echo ($episode->aired_on)->format('d/m/Y'); ?>
                    <?php else: ?>
                    00/00/0000
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-2">
                <p class="text-white text-center">
                    <i class="fas fa-clock" aria-hidden="true"></i>
                    <?php if($episode->duration): ?>
                    <?php echo ($episode->duration)->format('H:i:s'); ?>
                    <?php else: ?>
                    00:00:00
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-2">
                <p class="text-white text-center">
                    <i class="fas fa-link" aria-hidden="true"></i>
                    <?php if($episode->hasSource): ?>
                    <a href="<?php echo e($episode->hasSource->data); ?>" class="text-white" target="_blank" rel="noopener">
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
                <th class="text-center"><?php echo ucfirst(__('app.gameTitle')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.trackTitle')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.trackDuration')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.trackType')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $episode->hasTracklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center"><?php echo e($track->track_id); ?></td>
                <td>
                    <?php $__currentLoopData = $track->hasComposers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.contact.show', ['uuid' => $artist->composedBy->uuid])); ?>" class="text-white">
                        <?php echo e($artist->composedBy->uname); ?>

                    </a><br />
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>
                    <a href="<?php echo e(route('admin.game.show', ['uuid' => $track->hasGame->uuid])); ?>" class="text-white">
                        <?php echo e($track->hasGame->title); ?>

                    </a>
                </td>
                <td>
                    <a href="<?php echo e(route('admin.track.show', ['uuid' => $track->track_uuid])); ?>" class="text-white">
                        <?php echo e($track->hasTrack->title); ?>

                    </a>
                </td>
                <td class="text-center">
                    <?php if($track->duration): ?>
                    <?php echo ($track->duration)->format('H:i:s'); ?>
                    <?php else: ?>
                    00:00:00
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo ucfirst(__('app.trackType' . ucfirst($track->track_type))); ?>
                </td>
                <td class="text-center">
                    <a href="<?php echo e(route('admin.game.show', ['uuid' => $track->hasGame->uuid])); ?>" class="btn btn-sm btn-info">
                        <i class="fas fa-gamepad" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
    
<div class="modal fade" id="modalContactsList" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <?php echo ucfirst(__('app.contactsList')); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    <?php $__currentLoopData = $episode->hasContacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <?php if($team->hasContact->gender === 'band'): ?>
                            <i class="fas fa-users" title="<?php echo ucfirst(__('app.band')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.band')); ?>"></i>
                            <?php elseif($team->hasContact->gender === 'feminine'): ?>
                            <i class="fas fa-venus" title="<?php echo ucfirst(__('app.feminine')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.feminine')); ?>"></i>
                            <?php elseif($team->hasContact->gender === 'masculine'): ?>
                            <i class="fas fa-mars" title="<?php echo ucfirst(__('app.masculine')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.masculine')); ?>"></i>
                            <?php elseif($team->hasContact->gender === 'neutral'): ?>
                            <i class="fas fa-transgender-alt" title="<?php echo ucfirst(__('app.neutral')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.neutral')); ?>"></i>
                            <?php else: ?>
                            <i class="fas fa-genderless" title="<?php echo ucfirst(__('app.unknown')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.unknown')); ?>"></i>
                            <?php endif; ?>
                            <?php echo e($team->hasContact->uname); ?></br />
                            <em>
                                <?php echo e($team->hasProfession->profession); ?>

                            </em>
                        </span>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                        <span class="float-right">
                            delete
                        </span>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
            </div>
        </div>
    </div>
</div>
          
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.trackCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modals.trackImport', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modals.relationEpisodeCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
<?php echo $__env->make('modals.episodeUpdate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$( function() {
    $("#contact_search").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
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
                            label: value.uname,
                            value: value.uname
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contact_uuid").val(ui.item.uuid);
		}
	});
    $("#staff_search").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
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
                            label: value.uname,
                            value: value.uname
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#staff_uuid").val(ui.item.uuid);
		}
	});
    $("#studio_search").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.studio.autocomplete', ['q']); ?>=" + request.term, function (data) {
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
                            label: value.studio,
                            value: value.studio
                        };
                    }));
                }
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
                            label: value.title,
                            value: value.title
                        };
                    }));
                }
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/episode/show.blade.php ENDPATH**/ ?>