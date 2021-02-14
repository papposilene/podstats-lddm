<!-- Modal: modalLinkUpdate -->
<div class="modal fade" id="modalLinkUpdate" tabindex="-1" role="dialog" aria-labelledby="modalLinkUpdateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.source.store') }}" class="needs-validation" novalidate />
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLinkUpdateTitle">
                        @ucfirst(__('app.sourceUpdate'))
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($listSources as $source)
                    <div class="input-group mb-3">
                        <input type="text" class="form-control border border-secondary" name="link[{{ $source->type }}][type]" value="{{ $source->type }}" placeholder="@ucfirst(__('app.' . $source->type))" aria-label="@ucfirst(__('app.language'))" disabled />
                        <input type="text" class="form-control border border-secondary" name="link[{{ $source->type }}][data]" value="" placeholder="{{ __('app.http') }}" aria-label="@ucfirst(__('app.' . $source->type))" autocomplete="off" required />
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
                    <button type="submit" class="btn btn-primary">@ucfirst(__('app.sourceUpdate'))</button>
                </div>
            </div>
        </div>
    </form>
</div>