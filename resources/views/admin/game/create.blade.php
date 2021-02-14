@extends('layouts.admin')
@section('title', @ucfirst(__('app.gameCreate')))

@section('content')            
<div class="row">
    <div class="col-8">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-white">
                @ucfirst(__('app.gameCreate'))
            </h1>
        </div>

        <form method="POST" action="{{ route('admin.game.store') }}" class="needs-validation" novalidate />
            @csrf
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
                <input type="text" class="form-control border border-primary" name="game_title" placeholder="@ucfirst(__('app.gameTitle'))" aria-label="@ucfirst(__('app.gameTitle'))" aria-describedby="form_title" required />
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-secondary text-white" id="form_date">
                        &nbsp;<i class="fas fa-calendar-check" aria-hidden="true" title="@ucfirst(__('app.gameDate'))"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" name="game_releasedOn" placeholder="{{ __('app.ddmmyy') }}" aria-label="@ucfirst(__('app.gameDate'))" aria-describedby="form_date" required />
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-secondary text-white" id="form_mode">
                        &nbsp;<i class="fas fa-list-ol" aria-hidden="true" title="@ucfirst(__('app.gameGenre'))"></i>
                    </span>
                </div>
                <select multiple class="form-control border border-primary" name="modes[]" aria-label="@ucfirst(__('app.gameMode'))" aria-describedby="form_mode" required />
                    <option value="single">@ucfirst(__('app.gameSingle'))</option>
                    <option value="multi">@ucfirst(__('app.gameMulti'))</option>
                    <option value="cooperative">@ucfirst(__('app.gameCooperative'))</option>
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
                    <option value="{{ $genre->uuid }}">{{ $genre->genre }}</option>
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
                <input type="text" class="form-control border border-primary" id="studio_name" name="studio_name" placeholder="@ucfirst(__('app.studio'))" autocomplete="off" aria-label="@ucfirst(__('app.studio'))" required />
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
                    <option value="{{ $console->uuid }}">{{ $console->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="studio_uuid" id="studio_uuid" value="" />
            <button type="submit" class="btn btn-primary mt-3 float-right">@ucfirst(__('app.gameStore'))</button>
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