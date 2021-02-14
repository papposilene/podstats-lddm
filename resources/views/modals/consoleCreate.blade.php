<!-- Modal: modalConsoleCreate -->
<div class="modal fade" id="modalConsoleCreate" tabindex="-1" role="dialog" aria-labelledby="modalConsoleCreateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.console.store') }}" class="needs-validation" novalidate />
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConsoleCreateTitle">@ucfirst(__('app.consoleCreate'))</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_console">
								<i class="fas fa-dice" aria-hidden="true"></i>
							</span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="console_name" placeholder="@ucfirst(__('app.console'))" autocomplete="off" aria-label="@ucfirst(__('app.console'))" aria-describedby="form_console" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_manufacturer">
                                &nbsp;<i class="fas fa-industry" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="manufacturer_name" id="manufacturers" placeholder="@ucfirst(__('app.company'))" autocomplete="off" aria-label="@ucfirst(__('app.company'))" aria-describedby="form_manufacturer" required />
                        <input type="hidden" name="manufacturer_uuid" id="manufacturer_uuid" value="" required />
                    </div>
                    <div class="form-row">
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_type">
                                        <i class="fas fa-laptop-house" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <select class="form-control border border-primary" name="console_type" aria-describedby="form_type" required />
                                    <option value="arcade">@ucfirst(__('app.arcade'))</option>
                                    <option value="handheld">@ucfirst(__('app.handheld'))</option>
                                    <option value="home">@ucfirst(__('app.home'))</option>
                                    <option value="micro">@ucfirst(__('app.micro'))</option>
                                    <option value="computer">@ucfirst(__('app.computer'))</option>
                                    <option value="hybrid">@ucfirst(__('app.hybrid'))</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border border-secondary text-white" id="form_generation">
                                        <i class="fas fa-hashtag" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-secondary" name="console_generation" placeholder="@ucfirst(__('app.generation'))" autocomplete="off" aria-label="@ucfirst(__('app.generation'))" aria-describedby="form_generation">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border border-secondary text-white" id="form_releasedOn">
                                        <i class="fas fa-calendar-check" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-secondary" name="console_releasedOn" placeholder="1970" autocomplete="off" aria-label="@ucfirst(__('app.releasedOn'))" aria-describedby="form_releasedOn">
                            </div>
                        </div>
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