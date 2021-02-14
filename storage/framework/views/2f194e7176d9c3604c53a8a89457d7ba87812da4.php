<?php $__env->startSection('title', $game->title); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <?php echo e($game->title); ?>

    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
            <a href="<?php echo e(route('admin.game.edit', ['uuid' => $game->uuid])); ?>" role="button" class="btn btn-sm btn-primary">
                <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.gameUpdate')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.gameUpdate')); ?></span>
            </a>
            <?php endif; ?>
            <a href="<?php echo e(route('public.game.show', ['uuid' => $game->uuid])); ?>" role="button" class="btn btn-sm btn-info" target="_blank">
                <i class="fas fa-external-link-alt" aria-hidden="true"></i>
            </a>
        </div>
        <form action="<?php echo e(route('admin.game.index')); ?>" method="POST">
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
        <h2 class="h4 text-white pt-3 pb-2">
        <i class="fas fa-users" aria-hidden="true"></i>
            <?php echo ucfirst(__('app.staffList')); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
            <div class="btn-group mr-2 float-right">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalGameCreate">
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
                        <th class="text-center">#</th>
                        <th class="text-center"><?php echo ucfirst(__('app.gender')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.uname')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.profession')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $game->inGames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($loop->iteration); ?></td>
                        <td class="text-center">
                            <?php if($staff->hasContact->gender === 'band'): ?>
                            <i class="fas fa-users" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.band')); ?>"></i>
                            <?php elseif($staff->hasContact->gender === 'feminine'): ?>
                            <i class="fas fa-venus" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.feminine')); ?>"></i>
                            <?php elseif($staff->hasContact->gender === 'masculine'): ?>
                            <i class="fas fa-mars" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.masculine')); ?>"></i>    
                            <?php else: ?>
                            <i class="fas fa-transgender-alt" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.neutral')); ?>"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.contact.show', ['uuid' => $staff->hasContact->uuid])); ?>" class="text-white">
                                <?php echo e($staff->hasContact->uname); ?>

                            </a>
                        </td>
                        <td><?php echo e($staff->hasProfession->profession); ?></td>
                        <td class="text-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                            <form method="POST" action="<?php echo e(route('admin.unlink.game')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="relation_uuid" value="<?php echo e($staff->uuid); ?>" />
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                                <a href="<?php echo e(route('admin.contact.edit', ['uuid' => $staff->hasContact->uuid])); ?>" class="btn btn-sm btn-info">
                                <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.edit')); ?>"></i>
                                </a>
                                <?php endif; ?>
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

        <?php if(count($game->inPodcasts) > 0): ?>
        <h2 class="text-white">
            <i class="fas fa-podcast" aria-hidden="true" title="<?php echo ucfirst(__('app.episodesList')); ?>"></i>
            <?php echo ucfirst(__('app.episodesList')); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalPodcast">
                <i class="fas fa-link" aria-hidden="true" title="<?php echo ucfirst(__('app.podcastLink')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.podcastLink')); ?></span>
            </button>
            <?php endif; ?>
        </h2>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center"><?php echo ucfirst(__('app.podcastName')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.episodeTitle')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.episodeAiredOn')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.episodeDuration')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $game->inPodcasts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($episode->id); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.podcast.show', ['uuid' => $episode->inPodcast->uuid])); ?>" class="text-white">
                                <?php echo e($episode->inPodcast->name); ?>

                            </a>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.episode.show', ['uuid' => $episode->uuid])); ?>" class="text-white">
                                <?php echo e($episode->title); ?>

                            </a>
                        </td>
                        <td class="text-center">
                            <?php if($episode->aired_on): ?>
                            <?php echo ($episode->aired_on)->format('d/m/Y'); ?>
                            <?php else: ?>
                            00/00/0000
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($episode->duration): ?>
                            <?php echo ($episode->duration)->format('H:i:s'); ?>
                            <?php else: ?>
                            00:00:00
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo e(route('admin.episode.show', ['uuid' => $episode->uuid])); ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.showData')); ?>"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-4">
        <div class="card mb-4">
            <h5 class="card-header">
                <?php echo e($game->title); ?>

            </h5>
            <ul class="list-group list-group-flush">
                <?php if($game->hasSerie): ?>
                <a href="<?php echo e(route('admin.serie.show', ['uuid' => $game->hasSerie->serie_uuid])); ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-stream" aria-hidden="true" title="<?php echo e($game->hasSerie->inSerie->serie); ?>"></i>
                    <?php echo e($game->hasSerie->inSerie->serie); ?>

                </a>
                <?php else: ?>
                <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalSerieGameAdd">
                    <i class="fas fa-stream" aria-hidden="true" title="<?php echo ucfirst(__('app.gameSerieAdd')); ?>"></i>
                    <?php echo ucfirst(__('app.gameSerieAdd')); ?>
                </a>
                <?php endif; ?>
                <?php if($game->studio_uuid): ?>
                <a href="<?php echo e(route('admin.studio.show', ['uuid' => $game->studio_uuid])); ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-terminal" aria-hidden="true" title="<?php echo ucfirst(__('app.studio')); ?>"></i>
                    <?php echo e($game->createdBy->studio); ?>

                </a>
                <?php else: ?>
                <li class="list-group-item text-justify">
                    <i class="fas fa-terminal" aria-hidden="true" title="<?php echo ucfirst(__('app.studio')); ?>"></i>
                    <?php echo ucfirst(__('app.studioUnknown')); ?>
                </li>
                <?php endif; ?>
                <li class="list-group-item text-justify">
                    <i class="fas fa-calendar-check" aria-hidden="true" title="<?php echo ucfirst(__('app.gameDate')); ?>"></i>
                    <?php if($game->released_on): ?>
                    <?php echo ($game->released_on)->format('d/m/Y'); ?>
                    <?php else: ?>
                    00/00/0000
                    <?php endif; ?>
                </li>
                <?php if($game->mode): ?>
                <?php $__currentLoopData = json_decode($game->mode); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item text-justify">
                    <i class="fas fa-list-ol" aria-hidden="true" title="<?php echo ucfirst(__('app.gameMode')); ?>"></i>
                    <?php echo ucfirst(__('app.game' . ucfirst($mode))); ?>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <li class="list-group-item text-justify">
                    ---
                </li>
                <?php endif; ?>
                <?php if($game->hasGenres): ?>
                <?php $__currentLoopData = $game->hasGenres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('admin.genre.show', ['uuid' => $genre->uuid])); ?>"  class="list-group-item list-group-item-action">
                    <i class="fas fa-list-ul" aria-hidden="true" title="<?php echo ucfirst(__('app.gameMode')); ?>"></i>
                    <?php echo e($genre->genre); ?>

                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <li class="list-group-item text-justify">
                    ---
                </li>
                <?php endif; ?>
                <?php if($game->hasConsoles): ?>
                <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalConsolesList">
                    <i class="fas fa-dice" aria-hidden="true" title="<?php echo ucfirst(__('app.consoles')); ?>"></i>
                    <?php echo ucfirst(__('app.consolesList')); ?>
                </a>
                <?php else: ?>
                <li class="list-group-item text-justify">
                    ---
                </li>
                <?php endif; ?>
            </ul>
            <div class="card-footer text-right">
                <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($game->updated_at)->format('d/m/Y @ H:i'); ?></small>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">
                <i class="fas fa-list-ol" aria-hidden="true" title="<?php echo ucfirst(__('app.links')); ?>"></i>
                <?php echo ucfirst(__('app.sources')); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                <div class="btn-toolbar mb-2 mb-md-0 float-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalSourceCreate">
                            <i class="fas fa-link" aria-hidden="true" title="<?php echo ucfirst(__('app.sourceStore')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.sourceStore')); ?></span>
                        </button>
                        <a href="<?php echo e(route('admin.source.index', ['uuid' => $game->uuid])); ?>" role="button" class="btn btn-sm btn-info">
                            <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.sourceStore')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.sourceStore')); ?></span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </h5>
            <?php if(count($game->hasLinks) > 0): ?>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $game->hasLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($link->data); ?>" class="list-group-item list-group-item-action">
                    <i class="<?php echo e($link->info->icon); ?>" aria-hidden="true" title="<?php echo ucfirst(__('app.' . $link->type)); ?>"></i>
                    <?php echo ucfirst(__('app.' . $link->type)); ?>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="card-footer text-right">
                <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($game->hasLinks->last()->updated_at)->format('d/m/Y @ H:i'); ?></small>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if($game->hasConsoles): ?>
<div class="modal fade" id="modalConsolesList" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <?php echo ucfirst(__('app.consolesList')); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    <?php $__currentLoopData = $game->hasConsoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.console.show', ['uuid' => $console->uuid])); ?>" class="list-group-item list-group-item-action">
                        <?php echo e($console->name); ?>

                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.serieGameAdd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modals.sourceGameCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modals.relationGameCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
});
$( function() {
    $("#serie_search").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.serie.autocomplete', ['s' => 'false', 'q']); ?>=" + request.term, function (data) {
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
                            label: value.serie,
                            value: value.serie
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#serie_uuid").val(ui.item.uuid);
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/game/show.blade.php ENDPATH**/ ?>