<!-- Modal: modalTrackCreate -->
<div class="modal fade" id="modalTrackCreate" tabindex="-1" role="dialog" aria-labelledby="modalTrackCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.track.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="podcast_uuid" id="podcast_uuid" value="<?php echo e($episode->podcast_uuid); ?>" />
        <input type="hidden" name="episode_uuid" id="episode_uuid" value="<?php echo e($episode->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTrackCreateTitle"><?php echo ucfirst(__('app.trackCreate')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_tid">
                                        &nbsp;<i class="fas fa-hashtag"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="track_id" value="<?php echo e($trackLastId + 1); ?>" placeholder="<?php echo ucfirst(__('app.trackId')); ?>" aria-label="<?php echo ucfirst(__('app.trackId')); ?>" aria-describedby="form_tid">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_type">
                                        <i class="fas fa-audio-description"></i>
                                    </span>
                                </div>
                                <select class="form-control border border-primary" name="track_type" aria-describedby="form_type">
                                    <option value="actuality"><?php echo ucfirst(__('app.trackTypeActuality')); ?></option>
                                    <option value="cover"><?php echo ucfirst(__('app.trackTypeCover')); ?></option>
                                    <option value="playlist"><?php echo ucfirst(__('app.trackTypePlaylist')); ?></option>
                                    <option value="other"><?php echo ucfirst(__('app.trackTypeOther')); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                &nbsp;<i class="fas fa-user"></i>
                            </span>
                        </div>
                        <select class="form-control border border-primary" name="profession_uuid">
                            <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <input type="text" class="form-control border border-primary" name="contact_uname" id="contact_search" placeholder="<?php echo ucfirst(__('app.trackAuthor')); ?>" aria-label="<?php echo ucfirst(__('app.trackAuthor')); ?>" aria-describedby="form_artist">
                        <input type="hidden" name="contact_uuid" id="contact_uuid" value="" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-dice"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="studio_name" id="studio_search" placeholder="<?php echo ucfirst(__('app.studioName')); ?>" aria-label="<?php echo ucfirst(__('app.trackAuthor')); ?>" aria-describedby="form_artist">
                        <input type="hidden" name="studio_uuid" id="studio_uuid" value="" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-gamepad"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="game_title" id="game_search" placeholder="<?php echo ucfirst(__('app.gameTitle')); ?>" aria-label="<?php echo ucfirst(__('app.gameTitle')); ?>" aria-describedby="form_game">
                        <input type="hidden" name="game_uuid" id="game_uuid" value="" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                &nbsp;<i class="fas fa-audio-description"></i>
                            </span>
                        </div>
						<input type="text" class="form-control border border-primary" name="track_title" placeholder="<?php echo ucfirst(__('app.trackTitle')); ?>" aria-label="<?php echo ucfirst(__('app.trackTitle')); ?>" aria-describedby="form_title">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                &nbsp;<i class="fas fa-calendar-check"></i>&nbsp;
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="track_date" placeholder="<?php echo e(__('app.ddmmyy')); ?>" aria-label="<?php echo ucfirst(__('app.trackDate')); ?>" aria-describedby="form_date">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                &nbsp;<i class="fas fa-file-audio"></i>&nbsp;
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="track_mbid" placeholder="<?php echo ucfirst(__('app.mbid')); ?>" aria-label="<?php echo ucfirst(__('app.mbid')); ?>" aria-describedby="form_mbid">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                &nbsp;<i class="fas fa-link"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="track_source" placeholder="<?php echo ucfirst(__('app.trackSource')); ?>" aria-label="<?php echo ucfirst(__('app.trackSource')); ?>" aria-describedby="form_source">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right"><?php echo ucfirst(__('app.trackStore')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/modals/trackCreate.blade.php ENDPATH**/ ?>