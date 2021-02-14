<!-- Modal: modalSourceCreate -->
<div class="modal fade" id="modalSourceCreate" tabindex="-1" role="dialog" aria-labelledby="modalSourceCreateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.source.store') }}" class="needs-validation" novalidate />
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSourceCreateTitle">
                        @ucfirst(__('app.sourceCreate'))
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" value="{{ $contact->uname }}" disabled="disabled" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-link" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="source_data" placeholder="{{ __('app.http') }}" autocomplete="off" autofocus="1" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                            </span>
                        </div>
                        <select type="text" class="form-control border border-primary" name="source_type" required />
                        @foreach($listSources as $source)
                            <option value="{{ $source->type }}">@ucfirst(__('app.' . $source->type))</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="item_model" value="contact" required />
                <input type="hidden" name="item_uuid" id="item_uuid" value="{{ $contact->uuid }}" required />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
                    <button type="submit" class="btn btn-primary">@ucfirst(__('app.save'))</button>
                </div>
            </div>
        </div>
    </form>
</div>