<?php $__env->startSection('title', $podcast->name); ?>

<?php $__env->startSection('content'); ?>                
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col-md-7">
            <div class="card-body">
                <h1 class="card-title text-center"><?php echo e($podcast->name); ?></h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <i class="fas fa-calendar-check" aria-hidden="true"></i>
                            <?php echo ($podcast->began_on)->format('d/m/Y'); ?>
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-calendar-times" aria-hidden="true"></i> 
                            <?php if($podcast->ended_on): ?>
                            <?php echo ($podcast->ended_on)->format('d/m/Y'); ?>
                            <?php else: ?>
                            <?php echo ucfirst(__('app.podcastAiring')); ?>
                            <?php endif; ?>
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-broadcast-tower" aria-hidden="true"></i> 
                            <?php echo ucfirst(__('app.episodeTotal', ['episode' => count($podcast->hasEpisodes)])); ?>
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-clock" aria-hidden="true"></i> 
                            <?php
                            $now = Carbon\Carbon::now();
                            $duration = Carbon\Carbon::now();
                            foreach ($podcast->hasEpisodes as $episode)
                            {
                                $time = $episode->duration;
                                $duration = $duration->subSeconds($time->second)->subMinutes($time->minute)->subHours($time->hour);
                            }
                            ?>
                            <?php echo e($now->shortAbsoluteDiffForHumans($duration, 3)); ?>

                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-link" aria-hidden="true"></i> 
                            <?php if($podcast->hasSource): ?>
                            <a href="<?php echo e($podcast->hasSource->data); ?>" class="text-white" target="_blank" rel="noopener">
                                <?php echo ucfirst(__('app.podcastSource')); ?>
                            </a>
                            <?php else: ?>
                            ---
                            <?php endif; ?>
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($podcast->updated_at)->format('d/m/Y @ H:i'); ?></small>
                </p>
            </div>
        </div>
        <div class="col-md-5">
            <p class="p-4 text-justify">
                <?php echo e($podcast->description); ?>

            </p>
        </div>
    </div>
</div>

<?php echo e($episodes->links()); ?>

            
<div class="row">
    <?php $__currentLoopData = $episodes->chunk(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(count($episode->hasTracklist) > 0): ?>
            <a href="<?php echo e(route('public.episode.show', ['uuid' => $episode->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <?php else: ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php endif; ?>
                <span>
                    <strong><?php echo e($episode->id); ?>. <?php echo e($episode->title); ?></strong><br />
                    <em><?php echo ucfirst(__('app.seasonNb', ['season' => $episode->season])); ?>. <?php echo ($episode->aired_on)->format('d/m/Y'); ?>. <?php echo ($episode->duration)->format('H:i:s'); ?>.</em>
                </span>
                <span class="badge badge-primary badge-pill"><?php echo e(count($episode->hasTracklist)); ?></span>
            <?php if(count($episode->hasTracklist) > 0): ?>
            </a>
            <?php else: ?>
            </li>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
            
<?php echo e($episodes->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/podcast/show.blade.php ENDPATH**/ ?>