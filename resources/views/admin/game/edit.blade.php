@extends('layouts.admin')
@section('title', @ucfirst(__('app.gameEdit', ['game' => $game->title])))

@section('content')            
<div class="row">
    <div class="col-8">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-white">
                @ucfirst(__('app.gameEdit', ['game' => $game->title]))
            </h1>
        </div>

        <form method="POST" action="{{ route('admin.game.update') }}" name="game_editor" class="needs-validation" novalidate />
            @csrf
            <input type="hidden" name="game_uuid" value="{{ $game->uuid }}" required />
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4">@ucfirst(__('app.gameInformations'))</h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_title">
                        <i class="fas fa-gamepad" aria-hidden="true" title="@ucfirst(__('app.gameTitle'))"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" name="game_title" value="{{ $game->title }}" placeholder="@ucfirst(__('app.gameTitle'))" aria-label="@ucfirst(__('app.gameTitle'))" aria-describedby="form_title" required />
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-secondary text-white" id="form_date">
                        &nbsp;<i class="fas fa-calendar-check" aria-hidden="true" title="@ucfirst(__('app.gameDate'))"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" name="game_releasedOn" value="@if ($game->released_on)@datedit($game->released_on)@endif" placeholder="{{ __('app.ddmmyy') }}" aria-label="@ucfirst(__('app.gameDate'))" aria-describedby="form_date" required />
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-secondary text-white" id="form_mode">
                        &nbsp;<i class="fas fa-list-ol" aria-hidden="true" title="@ucfirst(__('app.gameGenre'))"></i>
                    </span>
                </div>
                <select multiple class="form-control border border-primary" name="modes[]" aria-label="@ucfirst(__('app.gameGenre'))" aria-describedby="form_mode" required />
                    <option value="single" @if ($game->mode === 'single') {{ 'selected' }} @endif>@ucfirst(__('app.gameSingle'))</option>
                    <option value="multi" @if ($game->mode === 'multi') {{ 'selected' }} @endif>@ucfirst(__('app.gameMulti'))</option>
                    <option value="cooperative" @if ($game->mode === 'cooperative') {{ 'selected' }} @endif>@ucfirst(__('app.gameCooperative'))</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_genre">
                        &nbsp;<i class="fas fa-list-ul" aria-hidden="true" title="@ucfirst(__('app.gameMode'))"></i>
                    </span>
                </div>
                <select multiple class="form-control border border-primary" name="genres[]" size="10" aria-label="@ucfirst(__('app.gameMode'))" aria-describedby="form_genre" required />
                    @foreach($genres as $genre)
                    <option value="{{ $genre->uuid }}" @if ($game->hasGenres->contains($genre->uuid)) {{ 'selected' }} @endif>{{ $genre->genre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4">@ucfirst(__('app.studiosList'))</h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_studio">
                        &nbsp;<i class="fas fa-terminal" aria-hidden="true"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" id="studio_name" name="studio_name" value="@if($game->studio_uuid){{ $game->createdBy->studio }}@endif" placeholder="@ucfirst(__('app.studio'))" autocomplete="off" aria-label="@ucfirst(__('app.studio'))" required />
            </div>
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4">@ucfirst(__('app.consolesList'))</h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_consoles">
                        &nbsp;<i class="fas fa-dice" aria-hidden="true"></i>
                    </span>
                </div>
                <select multiple class="form-control border border-primary" name="consoles[]" size="10" aria-label="@ucfirst(__('app.console'))" aria-describedby="form_consoles" required />
                    @foreach($consoles as $console)
                    <option value="{{ $console->uuid }}" @if ($game->hasConsoles->contains($console->uuid)) {{ 'selected' }}@endif>{{ $console->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="studio_uuid" id="studio_uuid" value="@if($game->studio_uuid){{ $game->studio_uuid }}@endif" />
            <button type="submit" class="btn btn-primary mt-3 float-right">@ucfirst(__('app.gameUpdate'))</button>
        </form>
    </div>
    <div class="col-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h2 class="h2 text-white">
                <i class="fas fa-list-ol" aria-hidden="true"></i>
                @ucfirst(__('app.dataLast'))
            </h2>
        </div>
        <div class="list-group list-group-flush">
            @foreach($games as $game)
            <a href="{{ route('admin.game.show', ['uuid' => $game->uuid]) }}" class="list-group-item list-group-item-action">
                {{ $game->title }} @if($game->released_on)(@year($game->released_on))@endif
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        })
    }, false);
})();

$(function() {
    $("#studio_name").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.studio.autocomplete', ['q']) !!}=" + request.term, function (data) {
                if(!data.length){
                    var result = [{
                        label: '@ucfirst(__('app.searchNotFound'))',
                        value: response.term
                    }];
                    response(result);
                }
                else
                {
                    response($.map(data, function (value, key) {
                        return {
                            uuid: value.uuid,
                            label: value.studio,
                            value: value.studio
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#studio_uuid").val(ui.item.uuid);
		}
	});
});
</script>
@endsection