<!-- Modal: modalTracklistImport -->
<div class="modal fade" id="modalTracklistImport" tabindex="-1" role="dialog" aria-labelledby="modalTrackImportTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.track.import') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="podcast_uuid" id="podcast_uuid" value="{{ $episode->podcast_uuid }}" required />
        <input type="hidden" name="episode_uuid" id="episode_uuid" value="{{ $episode->uuid }}" required />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTrackImportTitle">
						@ucfirst(__('app.trackImport'))
					</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="importFile"><i class="fas fa-file-import"></i></span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="importedFile" class="custom-file-input border border-primary" id="importFile" aria-describedby="importFile" required />
                            <label class="custom-file-label border border-primary" for="importFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
                    <button type="submit" class="btn btn-primary">@ucfirst(__('app.trackImport'))</button>
                </div>
            </div>
        </div>
    </form>
</div>