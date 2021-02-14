<?php $__env->startSection('title', $contact->uname); ?>

<?php $__env->startSection('content'); ?>            
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <?php echo e($contact->uname); ?>

    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
            <a href="<?php echo e(route('admin.contact.edit', ['uuid' => $contact->uuid])); ?>" class="btn btn-sm btn-primary" role="button">
                <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.contactUpdate')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.contactUpdate')); ?></span>
            </a>
            <?php endif; ?>
            <a href="<?php echo e(route('public.contact.show', ['uuid' => $contact->uuid])); ?>" role="button" class="btn btn-sm btn-info" target="_blank">
                <i class="fas fa-external-link-alt" aria-hidden="true"></i>
            </a>
        </div>
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

<div class="row">
    <div class="col-8">
        <?php if(count($contact->hasGames) > 0): ?>
        <h2 class="text-white">
            <i class="fas fa-gamepad" aria-hidden="true" title="<?php echo ucfirst(__('app.gamesList')); ?>"></i>
            <?php echo ucfirst(__('app.gamesList')); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalGameCreate">
                <?php echo ucfirst(__('app.tracksLink')); ?>
            </button>
            <?php endif; ?>
        </h2>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center"><?php echo ucfirst(__('app.studio')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.gameTitle')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.gameDate')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.profession')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $contact->hasGames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($loop->iteration); ?></td>
                        <td>
                            <?php if($game->hasGame->studio_uuid): ?>
                            <a href="<?php echo e(route('admin.studio.show', ['uuid' => $game->hasGame->studio_uuid])); ?>" class="text-white">
                                <?php echo e($game->hasGame->createdBy->studio); ?>

                            </a>
                            <?php else: ?>
                            <?php echo ucfirst(__('app.studioUnknown')); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.game.show', ['uuid' => $game->hasGame->uuid])); ?>" class="text-white">
                                <?php echo e($game->hasGame->title); ?>

                            </a>
                        </td>
                        <td class="text-center">
                            <?php if($game->hasGame->released_on): ?>
                            <?php echo ($game->hasGame->released_on)->format('d/m/Y'); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo e($game->hasProfession->profession); ?>

                        </td>
                        <td class="text-center">
                            <a href="<?php echo e(route('admin.game.show', ['uuid' => $game->hasGame->uuid])); ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.showData')); ?>"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <?php if(count($contact->hasTracks) > 0): ?>
        <h2 class="text-white">
            <i class="fas fa-music" aria-hidden="true" title="<?php echo ucfirst(__('app.tracksList')); ?>"></i>
            <?php echo ucfirst(__('app.tracksList')); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalTrackLink">
                <?php echo ucfirst(__('app.tracksLink')); ?>
            </button>
            <?php endif; ?>
        </h2>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center"><?php echo ucfirst(__('app.gameTitle')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.trackTitle')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.trackDuration')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $contact->hasTracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($loop->iteration); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.game.show', ['uuid' => $track->composedFor->uuid])); ?>" class="text-white">
                                <?php echo e($track->composedFor->title); ?>

                            </a>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.track.show', ['uuid' => $track->track_uuid])); ?>" class="text-white">
                                <?php echo e($track->hasComposed->title); ?>

                            </a>
                        </td>
                        <td class="text-center">
                            <?php if($track->hasComposed->duration): ?>
                            <?php echo ($track->hasComposed->duration)->format('H:i:s'); ?>
                            <?php else: ?>
                            00:00:00
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo e(route('admin.track.show', ['uuid' => $track->uuid])); ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.showData')); ?>"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <?php if(count($contact->hasEpisodes) > 0): ?>
        <h2 class="text-white">
            <i class="fas fa-podcast" aria-hidden="true" title="<?php echo ucfirst(__('app.episodesList')); ?>"></i>
            <?php echo ucfirst(__('app.episodesList')); ?>
        </h2>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center"><?php echo ucfirst(__('app.podcastName')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.episodeTitle')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.profession')); ?></th>
                        <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $contact->hasEpisodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($loop->iteration); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.podcast.show', ['uuid' => $episode->hasPodcast->uuid])); ?>" class="text-white">
                                <?php echo e($episode->hasPodcast->name); ?>

                            </a>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.episode.show', ['uuid' => $episode->hasEpisode->uuid])); ?>" class="text-white">
                                <?php echo e($episode->hasEpisode->title); ?>

                            </a>
                        </td>
                        <td>
                            <?php echo e($episode->hasProfession->profession); ?>

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
            <h5 class="card-header d-flex justify-content-between align-items-center">
                <span><?php echo e($contact->uname); ?></span>
                <span class="badge badge-secondary badge-pill">
                    <?php if($contact->gender === 'band'): ?>
                    <i class="fas fa-users" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.band')); ?>"></i>
                    <?php elseif($contact->gender === 'feminine'): ?>
                    <i class="fas fa-venus" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.feminine')); ?>"></i>
                    <?php elseif($contact->gender === 'masculine'): ?>
                    <i class="fas fa-mars" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.masculine')); ?>"></i>
                    <?php elseif($contact->gender === 'neutral'): ?>
                    <i class="fas fa-transgender-alt" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.neutral')); ?>"></i>
                    <?php else: ?>
                    <i class="fas fa-genderless" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.neutral')); ?>"></i>
                    <?php endif; ?>
                </span>
            </h5>
            <ul class="list-group list-group-flush">
                <?php if($contact->gender === 'band'): ?>
                <li class="list-group-item">
                    <?php echo ucfirst(__('app.band')); ?>.
                </li>
                <?php else: ?>
                <li class="list-group-item">
                    <?php echo ucfirst(__('app.fname')); ?> : <?php echo e($contact->fname); ?>.<br />
                    <?php echo ucfirst(__('app.lname')); ?> : <?php echo e($contact->lname); ?>.
                </li>
                <?php endif; ?>
                <?php if($contact->born_at && $contact->born_on): ?>
                <li class="list-group-item">
                    <?php if($contact->born_on): ?>
                    <?php echo ucfirst(__('app.bornOn')); ?> : <?php echo ($contact->born_on)->format('d/m/Y'); ?>.<br />
                    <?php else: ?>
                    <?php echo ucfirst(__('app.bornOn')); ?> : <?php echo ucfirst(__('app.bornOnUnknown')); ?>.<br />
                    <?php endif; ?>
                    <?php if($contact->born_at): ?>
                    <?php echo ucfirst(__('app.bornAt')); ?> : <?php echo e($contact->bornAt->name_eng_common); ?>.
                    <?php else: ?>
                    <?php echo ucfirst(__('app.bornAt')); ?> : <?php echo ucfirst(__('app.bornAtUnknown')); ?>.
                    <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php if($contact->died_at && $contact->died_on): ?>
                <li class="list-group-item">
                    <?php if($contact->died_on): ?>
                    <?php echo ucfirst(__('app.diedOn')); ?> : <?php echo ($contact->died_on)->format('d/m/Y'); ?>.<br />
                    <?php else: ?>
                    <?php echo ucfirst(__('app.diedOn')); ?> : <?php echo ucfirst(__('app.diedOnUnknown')); ?>.<br />
                    <?php endif; ?>
                    <?php if($contact->died_at): ?>
                    <?php echo ucfirst(__('app.diedAt')); ?> : <?php echo e($contact->diedAt->name_eng_common); ?>.
                    <?php else: ?>
                    <?php echo ucfirst(__('app.diedAt')); ?> : <?php echo ucfirst(__('app.diedAtUnknown')); ?>.
                    <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php if($contact->biography): ?>
                <li class="list-group-item text-justify">
                    <?php echo e($contact->biography); ?>

                </li>
                <?php endif; ?>
            </ul>
            <div class="card-footer text-right">
                <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($contact->updated_at)->format('d/m/Y @ H:i'); ?></small>
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
                        <a href="<?php echo e(route('admin.source.index', ['uuid' => $contact->uuid])); ?>" role="button" class="btn btn-sm btn-info">
                            <i class="fas fa-search" aria-hidden="true" title="<?php echo ucfirst(__('app.sourceStore')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.sourceStore')); ?></span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </h5>
            <?php if(count($contact->hasLinks) > 0): ?>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $contact->hasLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($link->data); ?>" class="list-group-item list-group-item-action">
                    <i class="<?php echo e($link->info->icon); ?>" aria-hidden="true" title="<?php echo ucfirst(__('app.' . $link->type)); ?>"></i>
                    <?php echo ucfirst(__('app.' . $link->type)); ?>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="card-footer text-right">
                <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($contact->hasLinks->last()->updated_at)->format('d/m/Y @ H:i'); ?></small>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
<?php echo $__env->make('modals.sourceContactCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$( function() {
    $("#podcasts").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.podcast.autocomplete', ['q']); ?>=" + request.term, function (data) {
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
                            label: value.name,
                            value: value.name,
                            uuid: value.uuid
                        };
                    }));
                }
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/contact/show.blade.php ENDPATH**/ ?>