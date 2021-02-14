<?php $__env->startSection('title', $game->title); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <h1 class="card-title text-center"><?php echo e($game->title); ?></h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <?php if($game->released_on): ?>
                            <?php echo ($game->released_on)->format('d/m/Y'); ?>
                            <?php else: ?>
                            00/00/0000
                            <?php endif; ?>
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <?php if($game->createdBy): ?>
                            <?php if($game->createdBy->locatedAt): ?>
                            <?php echo e($game->createdBy->locatedAt->flag); ?>

                            <?php else: ?>
                            <?php echo ucfirst(__('app.studioCountryUnknown')); ?>
                            <?php endif; ?>
                            <a href="<?php echo e(route('public.studio.show', ['uuid' => $game->studio_uuid])); ?>" class="text-white">
                                <?php echo e($game->createdBy->studio); ?>

                            </a>
                            <?php else: ?>
                            <?php echo ucfirst(__('app.studioUnknown')); ?>
                            <?php endif; ?>
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($game->updated_at)->format('d/m/Y @ H:i'); ?></small>
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <?php
                        $modes = json_decode($game->mode, true);
                        ?>
                        <?php $__currentLoopData = $modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-inline-item">
                            <?php echo ucfirst(__('app.game' . ucfirst($mode))); ?>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                    <ol class="list-inline text-center">
                        <?php $__currentLoopData = $game->hasGenres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-inline-item">
                            <a href="<?php echo e(route('public.genre.show', ['uuid' => $genre->uuid])); ?>" class="text-white">
                                <?php echo e($genre->genre); ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                    <ol class="list-inline text-center">
                        <?php $__currentLoopData = $game->hasConsoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-inline-item">
                            <a href="<?php echo e(route('public.console.show', ['uuid' => $console->uuid])); ?>" class="text-white">
                                <?php echo e($console->name); ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-1">
    <?php if($game->hasSerie): ?>
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header"><?php echo e($game->hasSerie->inSerie->serie); ?></h2>
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <?php echo ucfirst(__('app.achievementSerie')); ?>
                </div>
                <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalSerie">
                    <?php
                    $inEpisodes = $series->where('serie_uuid', $game->hasSerie->serie_uuid)->whereNotNull('game_uuid')->count();
                    $totalSerie = $series->where('serie_uuid', $game->hasSerie->serie_uuid)->count();
                    $seriePercent = round((($inEpisodes / $totalSerie) * 100), 2);
                    ?>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($seriePercent); ?>%;" aria-valuenow="<?php echo e($seriePercent); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($seriePercent); ?>%</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(count($game->hasTracklist) > 0): ?>
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header"><?php echo ucfirst(__('app.tracksList')); ?></h2>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $game->hasTracklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $track->inEpisodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('public.track.show', ['uuid' => $episode->track_uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <strong><?php echo e($episode->hasTrack->title); ?></strong>.<br />
                        <em>
                            <?php $__currentLoopData = $episode->hasComposers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($author->composedBy->uname); ?>.
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </em><br />
                        <?php echo e($episode->hasEpisode->id); ?>. <?php echo e($episode->hasEpisode->title); ?>, <?php echo ($episode->hasEpisode->aired_on)->format('d/m/Y'); ?>.
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

    <?php if(count($game->hasLinks) > 0): ?>
    <div class="col">
        <div class="card">
            <h2 class="h5 card-header"><?php echo ucfirst(__('app.sourcesList')); ?></h2>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $game->hasLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($source->data); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="<?php echo e($source->info->icon); ?>" aria-hidden="true" title="<?php echo ucfirst(__('app.' . $source->type)); ?>"></i>
                        <?php echo ucfirst(__('app.' . $source->type)); ?>
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>
    
<?php if($game->hasSerie): ?>
<div class="modal fade" id="modalSerie" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalSerieTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSerieTitle">
                    <?php echo e($game->hasSerie->inSerie->serie); ?>

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    <?php $__currentLoopData = $series->where('serie_uuid', $game->hasSerie->serie_uuid)->sortBy('game_order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(filled($serie->game_uuid)): ?>
                    <a href="<?php echo e(route('public.game.show', ['uuid' => $serie->game_uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><?php echo e($serie->game_order); ?>. <?php echo e($serie->game_title); ?></span>
                        <span class="badge badge-success badge-pill">
                            <i class="fas fa-check"></i>
                        </span>
                    </a>
                    <?php else: ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><?php echo e($serie->game_order); ?>. <?php echo e($serie->game_title); ?></span>
                        <span class="badge badge-danger badge-pill">
                            <i class="fas fa-times"></i>
                        </span>
                    </li>
                    <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/game/show.blade.php ENDPATH**/ ?>