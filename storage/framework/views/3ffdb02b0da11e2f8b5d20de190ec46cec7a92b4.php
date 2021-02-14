<!-- Modal: modalPodcastEdit -->
<div class="modal fade" id="modalPodcastEdit" tabindex="-1" role="dialog" aria-labelledby="modalPodcastEditTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.podcast.update')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="podcast_uuid" id="podcast_uuid" value="<?php echo e($podcast->uuid); ?>" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPodcastEditTitle">
						<?php echo ucfirst(__('app.podcastEdit', ['podcast' => $podcast->name])); ?>
					</h5>
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
                        <input type="text" name="podcast_name" class="form-control border border-primary" value="<?php echo e($podcast->name); ?>" id="form_image" aria-describedby="form_name" />
                    </div>
					<div class="form-row">
						<div class="col">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-primary border border-primary text-white" id="form_beganOn">
										<i class="fas fa-calendar-check"></i>
									</span>
								</div>
								<input type="text" class="form-control border border-primary" value="<?php echo e($podcast->began_on); ?>" name="podcast_beganOn" placeholder="1970-01-01" aria-label="<?php echo ucfirst(__('app.podcastBeganOn')); ?>" aria-describedby="form_beganOn">
							</div>
						</div>
						<div class="col">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-secondary border border-secondary text-white" id="form_endedOn">
										<i class="fas fa-calendar-times"></i>
									</span>
								</div>
								<input type="text" class="form-control border border-secondary" value="<?php echo e($podcast->ended_on); ?>" name="podcast_endedOn" placeholder="2000-12-31" aria-label="<?php echo ucfirst(__('app.podcastEndedOn')); ?>" aria-describedby="form_endedOn">
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
                        <div class="input-group-prepend">
							<span class="input-group-text bg-secondary border border-secondary text-white" id="form_description">
								<i class="fas fa-audio-description"></i>
							</span>
						</div>
						<textarea class="form-control border border-secondary" rows="7" name="podcast_description" placeholder="<?php echo ucfirst(__('app.podcastDescription')); ?>" aria-label="<?php echo ucfirst(__('app.podcastDescription')); ?>"><?php echo e($podcast->description); ?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_image">
								<i class="fas fa-image"></i>
							</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="podcast_cover" class="custom-file-input border border-primary" id="form_cover" aria-describedby="form_cover" />
                            <label class="custom-file-label border border-secondary" for="form_image">Choose file</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                <i class="fas fa-link"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="podcast_source" value="<?php if($podcast->linkedTo): ?><?php echo e($podcast->linkedTo->data); ?><?php endif; ?>" />
                        <input type="hidden" name="source_uuid" value="<?php if($podcast->linkedTo): ?><?php echo e($podcast->linkedTo->uuid); ?><?php endif; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.update')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/modals/podcastUpdate.blade.php ENDPATH**/ ?>