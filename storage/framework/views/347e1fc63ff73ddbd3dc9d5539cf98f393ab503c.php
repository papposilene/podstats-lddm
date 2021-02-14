<!-- Modal: modalEpisodeCreate -->
<div class="modal fade" id="modalEpisodeCreate" tabindex="-1" role="dialog" aria-labelledby="modalEpisodeCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.episode.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="podcast_uuid" value="<?php echo e($podcast->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEpisodeCreateTitle"><?php echo ucfirst(__('app.episodeCreate')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_sid"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="season_id" placeholder="<?php echo ucfirst(__('app.seasonId')); ?>" aria-label="<?php echo ucfirst(__('app.seasonId')); ?>" aria-describedby="form_sid">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_eid">
                                        <i class="fas fa-hashtag"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="episode_id" placeholder="<?php echo ucfirst(__('app.episodeId')); ?>" aria-label="<?php echo ucfirst(__('app.episodeId')); ?>" aria-describedby="form_eid">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_title">
                                <i class="fas fa-file-medical-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="episode_title" placeholder="<?php echo ucfirst(__('app.episodeTitle')); ?>" aria-label="<?php echo ucfirst(__('app.episodeTitle')); ?>" aria-describedby="form_title">
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_duration"><i class="fas fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="episode_duration" placeholder="<?php echo e(__('app.hhmmss')); ?>" aria-label="<?php echo e(__('app.hhmmss')); ?>" aria-describedby="form_duration">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_airedOn">
                                        <i class="fas fa-calendar-check"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="episode_airedOn" placeholder="<?php echo e(__('app.ddmmyy')); ?>" aria-label="<?php echo e(__('app.ddmmyy')); ?>" aria-describedby="form_airedOn">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_description">
                                <i class="fas fa-audio-description"></i>
                            </span>
                        </div>
                        <textarea class="form-control border border-secondary" rows="7" name="episode_description" placeholder="<?php echo ucfirst(__('app.episodeDescription')); ?>" aria-label="<?php echo ucfirst(__('app.episodeDescription')); ?>" aria-describedby="form_description"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_source">
                                <i class="fas fa-link"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="episode_source" placeholder="<?php echo ucfirst(__('app.episodeSource')); ?>" aria-label="<?php echo ucfirst(__('app.episodeSource')); ?>" aria-describedby="form_source">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right"><?php echo ucfirst(__('app.episodeStore')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/modals/episodeCreate.blade.php ENDPATH**/ ?>