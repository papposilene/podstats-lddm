<!-- Modal: modalPodcastEdit -->
<div class="modal fade" id="modalPodcastEdit" tabindex="-1" role="dialog" aria-labelledby="modalPodcastEditTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.podcast.update') }}" class="needs-validation" novalidate />
        @csrf
        <input type="hidden" name="podcast_uuid" id="podcast_uuid" value="{{ $podcast->uuid }}" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPodcastEditTitle">
						@ucfirst(__('app.podcastEdit', ['podcast' => $podcast->name]))
					</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
					<div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_name">
								<i class="fas fa-podcast" aria-hidden="true"></i>
							</span>
                        </div>
                        <input type="text" name="podcast_name" class="form-control border border-primary" value="{{ $podcast->name }}" autocomplete="off" id="form_name" aria-describedby="form_name" required />
                    </div>
					<div class="form-row">
						<div class="col">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-primary border border-primary text-white" id="form_beganOn">
										<i class="fas fa-calendar-check" aria-hidden="true"></i>
									</span>
								</div>
								<input type="text" class="form-control border border-primary" value="{{ $podcast->began_on }}" name="podcast_beganOn" placeholder="1970-01-01" autocomplete="off" aria-label="@ucfirst(__('app.podcastBeganOn'))" aria-describedby="form_beganOn" required />
							</div>
						</div>
						<div class="col">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-secondary border border-secondary text-white" id="form_endedOn">
										<i class="fas fa-calendar-times" aria-hidden="true"></i>
									</span>
								</div>
								<input type="text" class="form-control border border-secondary" value="{{ $podcast->ended_on }}" name="podcast_endedOn" placeholder="2000-12-31" autocomplete="off" aria-label="@ucfirst(__('app.podcastEndedOn'))" aria-describedby="form_endedOn" required />
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
                        <div class="input-group-prepend">
							<span class="input-group-text bg-secondary border border-secondary text-white" id="form_description">
								<i class="fas fa-audio-description" aria-hidden="true"></i>
							</span>
						</div>
						<textarea class="form-control border border-secondary" rows="7" name="podcast_description" placeholder="@ucfirst(__('app.podcastDescription'))" autocomplete="off" aria-label="@ucfirst(__('app.podcastDescription'))">{{ $podcast->description }}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_image">
								<i class="fas fa-image" aria-hidden="true"></i>
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
                        <input type="text" class="form-control border border-secondary" name="podcast_source" value="@if($podcast->linkedTo){{ $podcast->linkedTo->data }}@endif" />
                        <input type="hidden" name="source_uuid" value="@if($podcast->linkedTo){{ $podcast->linkedTo->uuid }}@endif">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
                    <button type="submit" class="btn btn-primary">@ucfirst(__('app.update'))</button>
                </div>
            </div>
        </div>
    </form>
</div>