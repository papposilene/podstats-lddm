@extends('layouts.admin')
@section('title', $episode->inPodcast->name . ' : ' . $episode->title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
        {{ $episode->title }}
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalContactsList">
                <i class="fas fa-users" aria-hidden="true" title="@ucfirst(__('app.contactsList'))"></i>
                <span class="sr-only">@ucfirst(__('app.contactsList'))</span>
            </button>
            @can('update')
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalRelationEpisodeCreate">
                <i class="fas fa-user-plus" aria-hidden="true" title="@ucfirst(__('app.episodeEdit', ['episode' => $episode->title]))"></i>
                <span class="sr-only">@ucfirst(__('app.episodeCreate'))</span>
            </button>
            @endcan
            @can('create')
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEpisodeEdit">
                <i class="fas fa-edit" aria-hidden="true" title="@ucfirst(__('app.episodeEdit', ['episode' => $episode->title]))"></i>
                <span class="sr-only">@ucfirst(__('app.episodeCreate'))</span>
            </button>
            @endcan
            <a href="{{ route('public.episode.show', ['uuid' => $episode->uuid]) }}" role="button" class="btn btn-sm btn-info" target="_blank">
                <i class="fas fa-external-link-alt" aria-hidden="true"></i>
            </a>
        </div>
        
        <form action="{{ route('admin.episode.search') }}" method="POST">
            @csrf
            <div class="input-group input-group-sm">
                <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="@ucfirst(__('app.search'))" aria-label="@ucfirst(__('app.search'))">
                <div class="input-group-append">
                    <button type="submit" class="bg-dark border border-secondary btn-sm text-white">
                        <i class="fas fa-search" aria-hidden="true" aria-label="@ucfirst(__('app.search'))"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
            
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3">
    <div class="col-12">
        <div class="row">
            <div class="col-2">
                <p class="text-white text-center">
                    <i class="fas fa-podcast" aria-hidden="true"></i>
                    <a href="{{ route('admin.podcast.show', ['uuid' => $episode->podcast_uuid]) }}" class="text-white">
                        {{ $episode->inPodcast->name }}
                    </a>
                </p>
            </div>
            <div class="col-2">
                <p class="text-white text-center">
                    <i class="fas fa-list-ol" aria-hidden="true"></i>
                    @ucfirst(__('app.seasonNb', ['season' => $episode->season]))
                </p>
            </div>
            <div class="col-2">
                <p class="text-white text-center">
                    <i class="fas fa-hashtag" aria-hidden="true"></i>
                    @ucfirst(__('app.episodeNb', ['episode' => $episode->id]))
                </p>
            </div>
            <div class="col-2">
                <p class="text-white text-center">
                    <i class="fas fa-calendar-check" aria-hidden="true"></i>
                    @if ($episode->aired_on)
                    @date($episode->aired_on)
                    @else
                    00/00/0000
                    @endif
                </p>
            </div>
            <div class="col-2">
                <p class="text-white text-center">
                    <i class="fas fa-clock" aria-hidden="true"></i>
                    @if ($episode->duration)
                    @time($episode->duration)
                    @else
                    00:00:00
                    @endif
                </p>
            </div>
            <div class="col-2">
                <p class="text-white text-center">
                    <i class="fas fa-link" aria-hidden="true"></i>
                    @if ($episode->hasSource)
                    <a href="{{ $episode->hasSource->data }}" class="text-white" target="_blank" rel="noopener">
                        @ucfirst(__('app.episodeSource'))
                    </a>
                    @else
                    ---
                    @endif
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-white text-justify">
                    {{ $episode->description }}
                </p>
            </div>
        </div>
    </div>
</div>

<h2 class="h4 text-white pt-3 pb-2 border-bottom">
    <i class="fas fa-users" aria-hidden="true"></i>
    @ucfirst(__('app.tracksList'))
    @can('create')
    <div class="btn-group mr-2 float-right">
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTrackCreate">
            <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.trackCreate'))"></i>
            <span class="sr-only">@ucfirst(__('app.trackCreate'))</span>
        </button>
        <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalTracklistImport">
            <i class="fas fa-file-import" aria-hidden="true" title="@ucfirst(__('app.trackImport'))"></i>
            <span class="sr-only">@ucfirst(__('app.trackImport'))</span>
        </button>
    </div>
    @endcan
</h2>

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">@ucfirst(__('app.trackAuthor'))</th>
                <th class="text-center">@ucfirst(__('app.gameTitle'))</th>
                <th class="text-center">@ucfirst(__('app.trackTitle'))</th>
                <th class="text-center">@ucfirst(__('app.trackDuration'))</th>
                <th class="text-center">@ucfirst(__('app.trackType'))</th>
                <th class="text-center">@ucfirst(__('app.actions'))</th>
            </tr>
        </thead>
        <tbody>
            @foreach($episode->hasTracklist as $track)
            <tr>
                <td class="text-center">{{ $track->track_id }}</td>
                <td>
                    @foreach($track->hasComposers as $artist)
                    <a href="{{ route('admin.contact.show', ['uuid' => $artist->composedBy->uuid]) }}" class="text-white">
                        {{ $artist->composedBy->uname }}
                    </a><br />
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.game.show', ['uuid' => $track->hasGame->uuid]) }}" class="text-white">
                        {{ $track->hasGame->title }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.track.show', ['uuid' => $track->track_uuid]) }}" class="text-white">
                        {{ $track->hasTrack->title }}
                    </a>
                </td>
                <td class="text-center">
                    @if ($track->duration)
                    @time($track->duration)
                    @else
                    00:00:00
                    @endif
                </td>
                <td>
                    @ucfirst(__('app.trackType' . ucfirst($track->track_type)))
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.game.show', ['uuid' => $track->hasGame->uuid]) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-gamepad" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    
<div class="modal fade" id="modalContactsList" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    @ucfirst(__('app.contactsList'))
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    @foreach($episode->hasContacts as $team)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            @if ($team->hasContact->gender === 'band')
                            <i class="fas fa-users" title="@ucfirst(__('app.band'))" aria-hidden="true" aria-label="@ucfirst(__('app.band'))"></i>
                            @elseif ($team->hasContact->gender === 'feminine')
                            <i class="fas fa-venus" title="@ucfirst(__('app.feminine'))" aria-hidden="true" aria-label="@ucfirst(__('app.feminine'))"></i>
                            @elseif ($team->hasContact->gender === 'masculine')
                            <i class="fas fa-mars" title="@ucfirst(__('app.masculine'))" aria-hidden="true" aria-label="@ucfirst(__('app.masculine'))"></i>
                            @elseif ($team->hasContact->gender === 'neutral')
                            <i class="fas fa-transgender-alt" title="@ucfirst(__('app.neutral'))" aria-hidden="true" aria-label="@ucfirst(__('app.neutral'))"></i>
                            @else
                            <i class="fas fa-genderless" title="@ucfirst(__('app.unknown'))" aria-hidden="true" aria-label="@ucfirst(__('app.unknown'))"></i>
                            @endif
                            {{ $team->hasContact->uname }}</br />
                            <em>
                                {{ $team->hasProfession->profession }}
                            </em>
                        </span>
                        @can('delete')
                        <span class="float-right">
                            delete
                        </span>
                        @endcan
                    </li>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
            </div>
        </div>
    </div>
</div>
          
@can('create')
@include('modals.trackCreate')
@include('modals.trackImport')
@include('modals.relationEpisodeCreate')
@endcan
@can('update')
@include('modals.episodeUpdate')
@endcan
@endsection

@can('create')
@section('js')
<script type="text/javascript">
$( function() {
    $("#contact_search").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.contact.autocomplete', ['q']) !!}=" + request.term, function (data) {
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
                            label: value.uname,
                            value: value.uname
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contact_uuid").val(ui.item.uuid);
		}
	});
    $("#staff_search").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.contact.autocomplete', ['q']) !!}=" + request.term, function (data) {
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
                            label: value.uname,
                            value: value.uname
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#staff_uuid").val(ui.item.uuid);
		}
	});
    $("#studio_search").autocomplete({
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
    $("#game_search").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.game.autocomplete', ['q']) !!}=" + request.term, function (data) {
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
                            label: value.title,
                            value: value.title
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#game_uuid").val(ui.item.uuid);
		}
	});
});
</script>
@endsection
@endcan