<?php $__env->startSection('title', $lddm->name); ?>

<?php $__env->startSection('content'); ?>
<div class="card mt-2 mb-3">
    <div class="card-body text-justify text-muted">
        Ce petit projet personnel intitulé <em>Podstats</em> n'existe que pour répondre à deux objectifs.
        Le premier consiste à permettre de faire un petit peu de statistiques et autres dataviz sur l'excellent podcast des <em>Démons du MIDI</em> :
        consoles ressorties, jeux vidéo présentés, artistes cités, bandes-sons explorées.
        Les honneurs dus à l'existence de ce podcast et de sa programmation doivent être rendu aux Césars que sont Gautoz, Pipomantis et Faskil, sans qui
        ce petit projet n'aurait pu voir le jour. Ce qui nous amène au second objectif, qui, quant à lui, est purement personnel : développer
        une application en faisant appel au framework Laravel pour le découvrir, l'appréhender et le maîtriser.
    </div>
</div>
<div class="card mt-2 mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="<?php echo e($lddm->cover); ?>" class="card-img-top img-fluid rounded" alt="<?php echo e($lddm->name); ?>" title="<?php echo e($lddm->name); ?>">
        </div>
        <div class="col-md-8">
            <h1 class="card-header text-center">
                <a href="<?php echo e(route('public.podcast.show', ['uuid' => $lddm->uuid])); ?>" class="text-white">
                    <?php echo e($lddm->name); ?>

                </a>
            </h1>
            <div class="card-body">
                <ol class="list-inline text-center text-secondary">
                    <li class="list-inline-item">
                        <i class="fas fa-calendar-check" aria-hidden="true"></i>
                        <?php echo ($lddm->began_on)->format('d/m/Y'); ?>
                    </li>
                    <li class="list-inline-item">
                        <i class="fas fa-calendar-times" aria-hidden="true"></i> 
                        <?php if($lddm->ended_on): ?>
                        <?php echo ($lddm->ended_on)->format('d/m/Y'); ?>
                        <?php else: ?>
                        <?php echo ucfirst(__('app.podcastAiring')); ?>
                        <?php endif; ?>
                    </li>
                    <li class="list-inline-item">
                        <i class="fas fa-broadcast-tower" aria-hidden="true"></i> 
                        <?php echo ucfirst(__('app.episodeTotal', ['episode' => count($lddm->hasEpisodes)])); ?>
                    </li>
                    <li class="list-inline-item">
                        <i class="fas fa-clock" aria-hidden="true"></i> 
                        <?php
                        $now = Carbon\Carbon::now();
                        $duration = Carbon\Carbon::now();
                        foreach ($lddm->hasEpisodes as $episode)
                        {
                            $time = $episode->duration;
                            $duration = $duration->subSeconds($time->second)->subMinutes($time->minute)->subHours($time->hour);
                        }
                        ?>
                        <?php echo e($now->shortAbsoluteDiffForHumans($duration, 3)); ?>

                    </li>
                </ol>
                <p class="card-text">
                    <?php echo e($lddm->description); ?>

                </p>
            </div>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $lddm->hasEpisodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($episode->hasTracklist) > 0): ?>
                <a href="<?php echo e(route('public.episode.show', ['uuid' => $episode->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <?php else: ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php endif; ?>
                    <span>
                        <strong><?php echo e($episode->id); ?>. <?php echo e($episode->title); ?></strong><br />
                        <em><?php echo ($episode->aired_on)->format('d/m/Y'); ?>. <?php echo ($episode->duration)->format('H:i:s'); ?>.</em>
                    </span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($episode->hasTracklist)); ?></span>
                <?php if(count($episode->hasTracklist) > 0): ?>
                </a>
                <?php else: ?>
                </li>
                <?php endif; ?>
                <?php if($loop->iteration == 6) break; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('public.podcast.show', ['uuid' => $lddm->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.episodesList')); ?>...</span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($lddm->hasEpisodes)); ?></span>
                </a>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/index.blade.php ENDPATH**/ ?>