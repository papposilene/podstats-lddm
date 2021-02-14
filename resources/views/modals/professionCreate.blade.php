<!-- Modal: modalProfessionCreate -->
<div class="modal fade" id="modalProfessionCreate" tabindex="-1" role="dialog" aria-labelledby="modalProfessionCreateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.profession.store') }}" class="needs-validation" novalidate />
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProfessionCreateTitle">
                        @ucfirst(__('app.professionCreate'))
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="profession[1][lang]" value="en" placeholder="@ucfirst(__('app.language'))" maxlength="2" aria-label="@ucfirst(__('app.language'))" required />
                        <input type="text" class="form-control border border-primary" name="profession[1][name]" placeholder="@ucfirst(__('app.profession'))" autocomplete="off" aria-label="@ucfirst(__('app.profession'))" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="profession[2][lang]" value="fr" placeholder="@ucfirst(__('app.language'))" aria-label="@ucfirst(__('app.language'))" required />
                        <input type="text" class="form-control border border-primary" name="profession[2][name]" placeholder="@ucfirst(__('app.profession'))" autocomplete="off" aria-label="@ucfirst(__('app.profession'))" required />
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