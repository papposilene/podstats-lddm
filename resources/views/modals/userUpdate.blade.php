<!-- Modal: modalUserUpdate -->
<div class="modal fade" id="modalUserUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUserUpdateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.user.update') }}" class="needs-validation" novalidate />
        @csrf
        <input type="hidden" name="user_uuid" value="{{ $user->uuid }}" required />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserUpdateTitle">@ucfirst(__('app.userUpdate'))</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border border-secondary" id="input-fname">
                                        <i class="fas fa-user" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="user_fname" class="form-control border border-secondary" placeholder="@ucfirst(__('app.fname'))" value="{{ $user->fname }}" autocomplete="off" aria-label="@ucfirst(__('app.fname'))" aria-describedby="input-fname" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border border-secondary" id="input-lname">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="user_lname" class="form-control border border-secondary" placeholder="@ucfirst(__('app.lname'))" value="{{ $user->lname }}" autocomplete="off" aria-label="@ucfirst(__('app.lname'))" aria-describedby="input-lname" />
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text border border-primary" id="input-username">
                                <i class="fas fa-user-secret" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" name="user_uname" class="form-control border border-primary" placeholder="@ucfirst(__('app.uname'))" value="{{ $user->uname }}" autocomplete="off" aria-label="@ucfirst(__('app.uname'))" aria-describedby="input-username" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text border border-primary" id="input-mail">
                                <i class="fas fa-at" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" name="user_email" class="form-control border border-primary" placeholder="@ucfirst(__('app.email'))" value="{{ $user->email }}" autocomplete="off" aria-label="@ucfirst(__('app.email'))" aria-describedby="input-mail" required />
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border border-primary" id="input-password1">
                                        <i class="fas fa-key" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="password" name="user_password" class="form-control border border-primary" placeholder="@ucfirst(__('app.password'))" autocomplete="off" aria-label="@ucfirst(__('app.password'))" aria-describedby="input-password1" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border border-primary" id="input-password2">
                                        <i class="fas fa-key" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="password" name="user_password_confirmation" class="form-control border border-primary" placeholder="@ucfirst(__('app.passwordConfirm'))" autocomplete="off" aria-label="@ucfirst(__('app.passwordConfirm'))" aria-describedby="input-password2" required />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right">@ucfirst(__('app.save'))</button>
                </div>
            </div>
        </div>
    </form>
</div>