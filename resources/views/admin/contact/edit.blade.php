@extends('layouts.admin')
@section('title', @ucfirst(__('app.contactEdit', ['contact' => $contact->uname])))

@section('content')
<div class="row">
    <div class="col-8">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-white">
                @ucfirst(__('app.contactEdit', ['contact' => $contact->uname]))
            </h1>
        </div>

        <form method="POST" action="{{ route('admin.contact.update') }}" class="needs-validation" novalidate />
            @csrf
            <input type="hidden" name="contact_uuid" value="{{ $contact->uuid }}" />
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4">@ucfirst(__('app.detailsIdentity'))</h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_uname">
                        <i class="fas fa-user-secret" aria-hidden="true" title="@ucfirst(__('app.uname'))"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" name="contact_uname" value="{{ $contact->uname }}" placeholder="@ucfirst(__('app.uname'))" autocomplete="off" aria-label="@ucfirst(__('app.uname'))" aria-describedby="form_uname" required />
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_gender">
                                <i class="fas fa-transgender-alt" aria-hidden="true" title="@ucfirst(__('app.gender'))"></i>
                            </span>
                        </div>
                        <select class="form-control border border-primary" name="contact_gender" aria-label="@ucfirst(__('app.gender'))" aria-describedby="form_gender" required />
                            <option value="">@ucfirst(__('app.gender'))</option>
                            <option value="band"@if($contact->gender === 'band') selected @endif>@ucfirst(__('app.band'))</option>
                            <option value="feminine"@if($contact->gender === 'feminine') selected @endif>@ucfirst(__('app.feminine'))</option>
                            <option value="masculine"@if($contact->gender === 'masculine') selected @endif>@ucfirst(__('app.masculine'))</option>
                            <option value="neutral"@if($contact->gender === 'neutral') selected @endif>@ucfirst(__('app.neutral'))</option>
                            <option value="unknown"@if($contact->gender === 'unknown') selected @endif>@ucfirst(__('app.unknown'))</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_fname">
                                <i class="fas fa-user" aria-hidden="true" title="@ucfirst(__('app.fname'))"></i>
                                <span class="sr-only">@ucfirst(__('app.fname'))</span>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_fname" value="{{ $contact->fname }}" placeholder="@ucfirst(__('app.fname'))" autocomplete="off" aria-label="@ucfirst(__('app.fname'))" aria-describedby="form_fname" />
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_mname">
                                <i class="fas fa-user" aria-hidden="true" title="@ucfirst(__('app.mname'))"></i>
                                <span class="sr-only">@ucfirst(__('app.mname'))</span>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_mname" value="{{ $contact->mname }}" placeholder="@ucfirst(__('app.mname'))" autocomplete="off" aria-label="@ucfirst(__('app.mname'))" aria-describedby="form_mname" />
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_lname">
                                <i class="fas fa-user" aria-hidden="true" title="@ucfirst(__('app.lname'))"></i>
                                <span class="sr-only">@ucfirst(__('app.lname'))</span>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_lname" value="{{ $contact->lname }}" placeholder="@ucfirst(__('app.lname'))" autocomplete="off" aria-label="@ucfirst(__('app.lname'))" aria-describedby="form_lname" />
                    </div>
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4">@ucfirst(__('app.detailsBiography'))</h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary border border-secondary text-white" id="form_livesAt">
                        <i class="fas fa-map-marked" aria-hidden="true" title="@ucfirst(__('app.livesAt'))"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-secondary" id="formLivesAt" value="@if($contact->lives_at){{ $contact->livesAt->name_eng_common }}@endif" placeholder="@ucfirst(__('app.livesAt'))" autocomplete="off" aria-label="@ucfirst(__('app.livesAt'))" aria-describedby="form_livesAt" />
                <input type="hidden" name="contact_livesAt" id="contacFormLivesAt" value="@if($contact->lives_at){{ $contact->lives_at }}@endif" />
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_bornOn">
                                <i class="fas fa-calendar-check" aria-hidden="true" title="@ucfirst(__('app.bornOn'))"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_bornOn" value="@if ($contact->born_on)@datedit($contact->born_on)@endif" placeholder="1970-01-01" aria-label="@ucfirst(__('app.bornOn'))" autocomplete="off" aria-describedby="form_bornOn" />
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_bornAt">
                                <i class="fas fa-globe" aria-hidden="true" title="@ucfirst(__('app.bornAt'))"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" id="formBornAt" value="@if($contact->born_at){{ $contact->bornAt->name_eng_common }}@endif" placeholder="@ucfirst(__('app.bornAt'))" autocomplete="off" aria-label="@ucfirst(__('app.bornAt'))" aria-describedby="form_bornAt" />
                        <input type="hidden" name="contact_bornAt" id="contactFormBornAt" value="@if($contact->born_at){{ $contact->born_at }}@endif" required />
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_diedOn">
                                <i class="fas fa-calendar-times" aria-hidden="true" title="@ucfirst(__('app.diedOn'))"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_diedOn" value="@if ($contact->died_on)@datedit($contact->died_on)@endif" placeholder="2000-12-31" aria-label="@ucfirst(__('app.diedOn'))" autocomplete="off" aria-describedby="form_diedOn" />
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_diedAt">
                                <i class="fas fa-globe" aria-hidden="true" title="@ucfirst(__('app.diedAt'))"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" id="formDiedAt" value="@if($contact->died_at){{ $contact->diedAt->name_eng_common }}@endif" placeholder="@ucfirst(__('app.diedAt'))" aria-label="@ucfirst(__('app.diedAt'))" aria-describedby="form_diedAt" />
                        <input type="hidden" name="contact_diedAt" id="contactFormDiedAt" value="@if($contact->died_at){{ $contact->died_at }}@endif" />
                    </div>
                </div>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary border border-secondary text-white">
                        <i class="fas fa-audio-description" aria-hidden="true" title="@ucfirst(__('app.biography'))"></i>
                    </span>
                </div>
                <textarea class="form-control border border-secondary" rows="10" name="contact_biography" placeholder="@ucfirst(__('app.biography'))" aria-label="@ucfirst(__('app.biography'))">{{ $contact->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3 float-right">@ucfirst(__('app.contactUpdate'))</button>
        </form>
    </div>
    <div class="col-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h2 class="h2 text-white">
                <i class="fas fa-list-ol" aria-hidden="true" title="@ucfirst(__('app.dataLast'))"></i>
                @ucfirst(__('app.dataLast'))
            </h2>
        </div>

        @if (count($contact->hasEpisodes) > 0)
        <div class="list-group list-group-flush">
            @foreach($contact->hasEpisodes as $episode)
            <a href="{{ route('admin.episode.show', ['uuid' => $episode->hasEpisode->uuid]) }}" class="list-group-item list-group-item-action">
                {{ $episode->hasEpisode->title }}
            </a>
            @break($loop->iteration == 5)
            @endforeach
        </div>
        @endif

        @if (count($contact->hasGames) > 0)
        <div class="list-group list-group-flush">
            @foreach($contact->hasGames as $game)
            <a href="{{ route('admin.game.show', ['uuid' => $game->hasGame->uuid]) }}" class="list-group-item list-group-item-action">
                {{ $game->hasGame->title }}
            </a>
            @break($loop->iteration == 5)
            @endforeach
        </div>
        @endif

        @if (count($contact->hasTracks) > 0)
        <div class="list-group list-group-flush">
            @foreach($contact->hasTracks as $track)
            <a href="{{ route('admin.track.show', ['uuid' => $track->uuid]) }}" class="list-group-item list-group-item-action">
                {{ $track->hasComposed->title }}
            </a>
            @break($loop->iteration == 5)
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$( function() {
    $("#formLivesAt").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.country.autocomplete', ['q']) !!}=" + request.term, function (data) {
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
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contacFormLivesAt").val(ui.item.uuid);
		}
	});
    $("#formNationality").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.country.autocomplete', ['q']) !!}=" + request.term, function (data) {
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
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contactFormNationality").val(ui.item.uuid);
		}
	});
    $("#formBornAt").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.country.autocomplete', ['q']) !!}=" + request.term, function (data) {
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
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contactFormBornAt").val(ui.item.uuid);
		}
	});
    $("#formDiedAt").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.country.autocomplete', ['q']) !!}=" + request.term, function (data) {
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
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
        minLength: 3,
        select: function( event, ui ) {
            $("#contactFormDiedAt").val(ui.item.uuid);
        }
	});
});
</script>
@endsection