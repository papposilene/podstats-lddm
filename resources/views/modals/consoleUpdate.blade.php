<!-- Modal: modalConsoleUpdate -->
<div class="modal fade" id="modalConsoleUpdate" tabindex="-1" role="dialog" aria-labelledby="modalConsoleUpdateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.console.update') }}" class="needs-validation" novalidate />
        @csrf
        <input type="hidden" name="console_uuid" value="{{ $console->uuid }}" />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConsoleUpdateTitle">
                        @ucfirst(__('app.consoleUpdate'))
                    </h5>
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
                        <input type="text" class="form-control border border-primary" name="console_name" value="{{ $console->name }}" placeholder="@ucfirst(__('app.console'))" autocomplete="off" aria-label="@ucfirst(__('app.console'))" aria-describedby="form_console" required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_manufacturer">
                                &nbsp;<i class="fas fa-industry" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="manufacturer_name" id="manufacturers" value="{{ $console->byManufacturer->company }}" placeholder="@ucfirst(__('app.company'))" autocomplete="off" aria-label="@ucfirst(__('app.company'))" aria-describedby="form_manufacturer" required />
                        <input type="hidden" name="manufacturer_uuid" id="manufacturer_uuid" value="{{ $console->manufacturer_uuid }}" required />
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
                                    <option value="arcade" @if($console->type === 'arcade') selected @endif>@ucfirst(__('app.arcade'))</option>
                                    <option value="handheld" @if($console->type === 'handheld') selected @endif>@ucfirst(__('app.handheld'))</option>
                                    <option value="home" @if($console->type === 'home') selected @endif>@ucfirst(__('app.home'))</option>
                                    <option value="micro" @if($console->type === 'micro') selected @endif>@ucfirst(__('app.micro'))</option>
                                    <option value="computer" @if($console->type === 'computer') selected @endif>@ucfirst(__('app.computer'))</option>
                                    <option value="hybrid" @if($console->type === 'hybrid') selected @endif>@ucfirst(__('app.hybrid'))</option>
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
                                <input type="text" class="form-control border border-secondary" name="console_generation" value="{{ $console->generation }}" placeholder="@ucfirst(__('app.generation'))" autocomplete="off" aria-label="@ucfirst(__('app.generation'))" aria-describedby="form_generation" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border border-secondary text-white" id="form_releasedOn">
                                        <i class="fas fa-calendar-check" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-secondary" name="console_releasedOn" value="{{ $console->released_on }}" placeholder="1970" autocomplete="off" aria-label="@ucfirst(__('app.releasedOn'))" aria-describedby="form_releasedOn" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
                    <button type="submit" class="btn btn-primary">@ucfirst(__('app.consoleUpdate'))</button>
                </div>
            </div>
        </div>
    </form>
</div>