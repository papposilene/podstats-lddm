<!-- Modal: modalTrackCreate -->
<div class="modal fade" id="modalTrackCreate" tabindex="-1" role="dialog" aria-labelledby="modalTrackCreateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.link.track') }}" class="needs-validation" novalidate />
        @csrf
        <input type="hidden" name="game_uuid" id="track_uuid" value="{{ $track->uuid }}" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTrackCreateTitle">
						@ucfirst(__('app.staffCreate'))
					</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_profession">
                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                            </span>
                        </div>
                        <select class="form-control border border-primary" name="profession_uuid" required />
                            @foreach($professions as $profession)
                            <option value="{{ $profession->uuid }}">{{ $profession->profession }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_contact">
                                <i class="fas fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="contact_uname" id="contact_search" placeholder="@ucfirst(__('app.contact'))" aria-label="@ucfirst(__('app.contact'))" required />
                    </div>
                </div>
                <input type="hidden" name="contact_uuid" id="contact_uuid" value="" required />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
                    <button type="submit" class="btn btn-primary">@ucfirst(__('app.save'))</button>
                </div>
            </div>
        </div>
    </form>
</div>