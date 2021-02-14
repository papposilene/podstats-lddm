<!-- Modal: modalStudioCreate -->
<div class="modal fade" id="modalStudioCreate" tabindex="-1" role="dialog" aria-labelledby="modalStudioCreateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.studio.store') }}" class="needs-validation" novalidate />
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalStudioCreateTitle">@ucfirst(__('app.studioCreate'))</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_studio">
								<i class="fas fa-terminal" aria-hidden="true"></i>
							</span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="studio_name" placeholder="@ucfirst(__('app.studioName'))" autocomplete="off" aria-label="@ucfirst(__('app.studioName'))" aria-describedby="form_studio" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_country">
                                &nbsp;<i class="fas fa-globe" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="country_name" id="countries" placeholder="@ucfirst(__('app.studioCountry'))" autocomplete="off" aria-label="@ucfirst(__('app.studioCountry'))" aria-describedby="form_country" required />
                        <input type="hidden" name="country_uuid" id="country_uuid" value="" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
                    <button type="submit" class="btn btn-primary">@ucfirst(__('app.save'))</button>
                </div>
            </div>
        </div>
    </form>
</div>