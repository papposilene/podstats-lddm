<?php $__env->startSection('title', $track->title); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col">
            <div class="card-body">
                <h1 class="card-title text-center"><?php echo e($track->title); ?></h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <?php $__currentLoopData = $track->hasArtists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-inline-item">
                            <a href="<?php echo e(route('public.contact.show', ['uuid' => $contact->composedBy->uuid])); ?>" class="text-white">
                                <?php echo e($contact->composedBy->uname); ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <?php if($track->released_on): ?>
                            <?php echo ($track->released_on)->format('d/m/Y'); ?>
                            <?php else: ?>
                            00/00/0000
                            <?php endif; ?>
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($track->updated_at)->format('d/m/Y @ H:i'); ?></small>
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="<?php echo e(route('public.game.show', ['uuid' => $track->hasGame->uuid])); ?>" class="h4 text-white">
                                <em><?php echo e($track->hasGame->title); ?></em>
                            </a>
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <?php if($track->hasGame->released_on): ?>
                            <?php echo ($track->hasGame->released_on)->format('d/m/Y'); ?>
                            <?php else: ?>
                            00/00/0000
                            <?php endif; ?>
                        </li>
                        <li class="list-inline-item">
                            <?php if($track->hasGame->createdBy): ?>
                            <?php if($track->hasGame->createdBy->locatedAt): ?>
                            <?php echo e($track->hasGame->createdBy->locatedAt->flag); ?>

                            <?php else: ?>
                            <?php echo ucfirst(__('app.studioCountryUnknown')); ?>
                            <?php endif; ?>
                            <a href="<?php echo e(route('public.studio.show', ['uuid' => $track->hasGame->studio_uuid])); ?>" class="text-white">
                                <?php echo e($track->hasGame->createdBy->studio); ?>

                            </a>
                            <?php else: ?>
                            <?php echo ucfirst(__('app.studioUnknown')); ?>
                            <?php endif; ?>
                        </li>
                        <?php if($track->hasGame->mode): ?>
                        <?php
                        $modes = json_decode($track->hasGame->mode, true);
                        ?>
                        <?php $__currentLoopData = $modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-inline-item">
                            <?php echo ucfirst(__('app.game' . ucfirst($mode))); ?>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if($track->hasGame->hasGenres): ?>
                        <?php $__currentLoopData = $track->hasGame->hasGenres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-inline-item">
                            <a href="<?php echo e(route('public.genre.show', ['uuid' => $genre->uuid])); ?>" class="text-white">
                                <?php echo e($genre->genre); ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ol>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-1">
    <?php if(count($track->inEpisodes) > 0): ?>
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header"><?php echo ucfirst(__('app.tracksList')); ?></h2>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $track->inEpisodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('public.episode.show', ['uuid' => $episode->episode_uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <em><?php echo e($episode->hasEpisode->inPodcast->name); ?></em><br />
                        <?php echo e($episode->hasEpisode->id); ?>. <strong><?php echo e($episode->hasEpisode->title); ?></strong>, <?php echo ($episode->hasEpisode->aired_on)->format('d/m/Y'); ?>.
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

    <?php if(count($track->hasLinks) > 0): ?>
    <div class="col">
        <div class="card">
            <h2 class="h5 card-header"><?php echo ucfirst(__('app.sourcesList')); ?></h2>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $track->hasLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/track/show.blade.php ENDPATH**/ ?>