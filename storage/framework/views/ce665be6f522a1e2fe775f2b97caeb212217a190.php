<!-- Modal: modalEpisodeEdit -->
<div class="modal fade" id="modalEpisodeEdit" tabindex="-1" role="dialog" aria-labelledby="modalEpisodeEditTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.episode.update')); ?>" enctype="multipart/form-data" class="needs-validation" novalidate />
        <?php echo csrf_field(); ?>
        <input type="hidden" name="podcast_uuid" value="<?php echo e($episode->inPodcast->uuid); ?>" />
        <input type="hidden" name="episode_uuid" value="<?php echo e($episode->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEpisodeEditTitle"><?php echo ucfirst(__('app.episodeUpdate')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_sid">
                                        <i class="fas fa-hashtag" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="season_id" value="<?php echo e($episode->season); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.seasonId')); ?>" aria-describedby="form_sid" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_eid">
                                        <i class="fas fa-hashtag" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="episode_id" value="<?php echo e($episode->id); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.episodeId')); ?>" aria-describedby="form_eid" required />
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_title">
                                <i class="fas fa-file-medical-alt" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="episode_title" value="<?php echo e($episode->title); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.episodeTitle')); ?>" aria-describedby="form_title" required />
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_duration">
                                        <i class="fas fa-clock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="episode_duration" value="<?php echo e($episode->duration->format('H:i:s')); ?>" autocomplete="off" aria-label="<?php echo e(__('app.hhmmss')); ?>" aria-describedby="form_duration" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_airedOn">
                                        <i class="fas fa-calendar-check"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="episode_airedOn" value="<?php echo e($episode->aired_on->format('Y-m-d')); ?>" autocomplete="off" aria-label="<?php echo e(__('app.ddmmyy')); ?>" aria-describedby="form_airedOn" required />
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_description">
                                <i class="fas fa-audio-description" aria-hidden="true"></i>
                            </span>
                        </div>
                        <textarea class="form-control border border-secondary" rows="7" name="episode_description" aria-label="<?php echo ucfirst(__('app.episodeDescription')); ?>" aria-describedby="form_description"><?php echo e($episode->description); ?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_source">
                                <i class="fas fa-link" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="episode_source" value="<?php if($episode->hasSource): ?><?php echo e($episode->hasSource->data); ?><?php endif; ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.episodeSource')); ?>" aria-describedby="form_source">
                        <input type="hidden" name="source_uuid" value="<?php if($episode->hasSource): ?><?php echo e($episode->hasSource->uuid); ?><?php endif; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right"><?php echo ucfirst(__('app.episodeStore')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/modals/episodeUpdate.blade.php ENDPATH**/ ?>