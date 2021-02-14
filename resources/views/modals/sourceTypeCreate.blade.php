<!-- Modal: modalSourceTypeCreate -->
<div class="modal fade" id="modalSourceTypeCreate" tabindex="-1" role="dialog" aria-labelledby="modalSourceTypeCreateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.source.type') }}" class="needs-validation" novalidate />
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSourceTypeCreateTitle">
                        @ucfirst(__('app.sourceTypeCreate'))
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-icons" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="source_icon" placeholder="{{ __('app.sourceIcons') }}" autocomplete="off" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-link" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="source_type" placeholder="@ucfirst(__('app.source'))" autocomplete="off" aria-label="@ucfirst(__('app.source'))" required />
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