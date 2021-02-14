<?php $__env->startSection('title', @ucfirst(__('app.podcastsList'))); ?>

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
                    <?php echo ucfirst(__('app.podcastsList')); ?>
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalPodcastCreate">
                            <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.podcastCreate')); ?>"></i>
                            <span class="sr-only"><?php echo ucfirst(__('app.podcastCreate')); ?></span>
                        </button>
                    </div>
					<?php endif; ?>
					<form action="<?php echo e(route('admin.podcast.index')); ?>" method="POST">
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
                
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"><?php echo ucfirst(__('app.podcastName')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.podcastBeganOn')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.podcastEndedOn')); ?></th>
                            <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $podcasts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $podcast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($podcast->name); ?></td>
                            <td class="text-center"><?php echo ($podcast->began_on)->format('d/m/Y'); ?></td>
                            <td class="text-center">
                                <?php if($podcast->ended_on): ?>
                                    <?php echo ($podcast->ended_on)->format('d/m/Y'); ?>
                                <?php else: ?>
                                    <?php echo ucfirst(__('app.podcastAiring')); ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                <form method="POST" action="<?php echo e(route('admin.podcast.delete')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="podcast_uuid" value ="<?php echo e($podcast->uuid); ?>" />
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('admin.podcast.show', ['uuid' => $podcast->uuid])); ?>" class="btn btn-sm btn-primary">
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

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
<!-- Modal: modalPodcastCreate -->
<div class="modal fade" id="modalPodcastCreate" tabindex="-1" role="dialog" aria-labelledby="modalPodcastCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.podcast.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPodcastCreateTitle"><?php echo ucfirst(__('app.podcastCreate')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_name">
                                <i class="fas fa-podcast"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="podcast_name" placeholder="<?php echo ucfirst(__('app.podcastName')); ?>" aria-label="<?php echo ucfirst(__('app.podcastName')); ?>" aria-describedby="form_name">
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="formBeganOn">
                                        <i class="fas fa-calendar-check"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="podcast_beganOn" placeholder="1970-01-01" aria-label="<?php echo ucfirst(__('app.podcastBeganOn')); ?>" aria-describedby="formBeganOn">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border border-secondary text-white" id="formEndedOn">
                                        <i class="fas fa-calendar-times"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-secondary" name="podcast_endedOn" placeholder="1990-01-01" aria-label="<?php echo ucfirst(__('app.podcastEndedOn')); ?>" aria-describedby="formEndedOn">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                <i class="fas fa-audio-description"></i>
                            </span>
                        </div>
                        <textarea class="form-control border border-secondary" rows="7" name="podcast_description" placeholder="<?php echo ucfirst(__('app.podcastDescription')); ?>" aria-label="<?php echo ucfirst(__('app.podcastDescription')); ?>"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                <i class="fas fa-link"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="podcast_source" placeholder="<?php echo ucfirst(__('app.podcastSource')); ?>" aria-label="<?php echo ucfirst(__('app.podcastSource')); ?>" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_cover">
                                <i class="fas fa-image"></i>
                            </span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="podcast_cover" class="custom-file-input border border-primary" id="form_image" aria-describedby="form_cover" />
                            <label class="custom-file-label border border-primary" for="form_image">Choose file</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right"><?php echo ucfirst(__('app.podcastStore')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/podcast/admin.blade.php ENDPATH**/ ?>