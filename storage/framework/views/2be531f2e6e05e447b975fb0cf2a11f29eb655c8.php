<?php $__env->startSection('title', $podcast->name); ?>

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
                    <i class="fas fa-podcast" aria-hidden="true"></i>
                    <?php echo e($podcast->name); ?>

                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalPodcastEdit">
                            <i class="fas fa-edit" aria-hidden="true" title="<?php echo ucfirst(__('app.podcastEdit', ['podcast' => $podcast->name])); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.podcastUpdate')); ?></span>
                        </button>
                    </div>
					<?php endif; ?>
					<form action="<?php echo e(route('admin.podcast.index')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="<?php echo ucfirst(__('app.search')); ?>" aria-label="<?php echo ucfirst(__('app.search')); ?>">
							<div class="input-group-append">
                                <button type="submit" class="btn-sm bg-dark border border-secondary text-white">
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
                                <i class="fas fa-calendar-check"></i> 
                                <?php echo ($podcast->began_on)->format('d/m/Y'); ?>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-broadcast-tower"></i> 
                                <?php echo ucfirst(__('app.episodeTotal', ['episode' => count($podcast->episodes)])); ?>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-clock"></i>
                                <?php
                                $duration = Carbon\Carbon::now();
                                foreach ($podcast->episodes as $episode) {
                                    $time = $episode->duration;
                                    $duration = $duration->subSeconds($time->second)->subMinutes($time->minute)->subHours($time->hour);
                                }
                                ?>
                                <?php echo e($duration->longAbsoluteDiffForHumans()); ?>

                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-calendar-check"></i>
                                <?php if($podcast->ended_on): ?>
                                <?php echo ($podcast->began_on)->format('d/m/Y'); ?>
                                <?php else: ?>
                                <?php echo ucfirst(__('app.podcastAiring')); ?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-link"></i>
                                <?php if($podcast->linkedTo): ?>
                                <a href="<?php echo e($podcast->linkedTo->data); ?>" class="text-white" target="_blank" rel="noopener">
                                    <?php echo ucfirst(__('app.podcastSource')); ?>
                                </a>
                                <?php else: ?>
                                -
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-white text-justify">
                                <?php echo e($podcast->description); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
                
            <h2 class="h4 text-white pt-3 pb-2">
                <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
                <?php echo ucfirst(__('app.episodesList')); ?>
                <div class="btn-group mr-2 float-right">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEpisodeCreate">
                            <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.episodeCreate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.episodeCreate')); ?></span>
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalEpisodeImport">
                            <i class="fas fa-file-import" aria-hidden="true" title="<?php echo ucfirst(__('app.episodeImport')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.episodeImport')); ?></span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('admin.episode.index')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="<?php echo ucfirst(__('app.search')); ?>" aria-label="<?php echo ucfirst(__('app.search')); ?>">
                            <div class="input-group-append">
                                <button type="submit" class="bg-dark btn-sm border border-secondary text-white">
                                    <i class="fas fa-search" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.search')); ?>"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </h2>
                
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo ucfirst(__('app.season')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeTitle')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeDuration')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeAiredOn')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeStaff')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.episodeTracks')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $podcast->episodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($episode->id); ?></td>
                            <td class="text-center"><?php echo e($episode->season); ?></td>
                            <td><?php echo e($episode->title); ?></td>
                            <td class="text-center"><?php echo ($episode->duration)->format('H:i:s'); ?></td>
                            <td class="text-center"><?php echo ($episode->aired_on)->format('d/m/Y'); ?></td>
                            <td class="text-center"><?php echo e(count($episode->staff)); ?></td>
                            <td class="text-center"><?php echo e(count($episode->tracklist)); ?></td>
                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                <form method="POST" action="<?php echo e(route('admin.episode.delete')); ?>" class="">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="episode_uuid" value ="<?php echo e($episode->uuid); ?>" />
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('admin.episode.show', ['uuid' => $episode->uuid])); ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                    </a>
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
        </main>
    </div>
</div>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
<?php echo $__env->make('modals.podcastUpdate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<?php echo $__env->make('modals.episodeCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modals.episodeImport', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/podcast/show.blade.php ENDPATH**/ ?>