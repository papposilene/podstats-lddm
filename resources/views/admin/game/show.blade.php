@extends('layouts.admin')
@section('title', $game->title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        {{ $game->title }}
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            @can('update')
            <a href="{{ route('admin.game.edit', ['uuid' => $game->uuid]) }}" role="button" class="btn btn-sm btn-primary">
                <i class="fas fa-edit" aria-hidden="true" title="@ucfirst(__('app.gameUpdate'))"></i>
                <span class="sr-only">@ucfirst(__('app.gameUpdate'))</span>
            </a>
            @endcan
            <a href="{{ route('public.game.show', ['uuid' => $game->uuid]) }}" role="button" class="btn btn-sm btn-info" target="_blank">
                <i class="fas fa-external-link-alt" aria-hidden="true"></i>
            </a>
        </div>
        <form action="{{ route('admin.game.index') }}" method="POST">
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

<div class="row">
    <div class="col-8">
        <h2 class="h4 text-white pt-3 pb-2">
        <i class="fas fa-users" aria-hidden="true"></i>
            @ucfirst(__('app.staffList'))
            @can('create')
            <div class="btn-group mr-2 float-right">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalGameCreate">
                    <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.staffCreate'))"></i>
                    <span class="sr-only">@ucfirst(__('app.staffCreate'))</span>
                </button>
            </div>
            @endcan
        </h2>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">@ucfirst(__('app.gender'))</th>
                        <th class="text-center">@ucfirst(__('app.uname'))</th>
                        <th class="text-center">@ucfirst(__('app.profession'))</th>
                        <th class="text-center">@ucfirst(__('app.actions'))</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($game->inGames as $staff)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            @if ($staff->hasContact->gender === 'band')
                            <i class="fas fa-users" aria-hidden="true" aria-label="@ucfirst(__('app.band'))"></i>
                            @elseif ($staff->hasContact->gender === 'feminine')
                            <i class="fas fa-venus" aria-hidden="true" aria-label="@ucfirst(__('app.feminine'))"></i>
                            @elseif ($staff->hasContact->gender === 'masculine')
                            <i class="fas fa-mars" aria-hidden="true" aria-label="@ucfirst(__('app.masculine'))"></i>    
                            @else
                            <i class="fas fa-transgender-alt" aria-hidden="true" aria-label="@ucfirst(__('app.neutral'))"></i>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.contact.show', ['uuid' => $staff->hasContact->uuid]) }}" class="text-white">
                                {{ $staff->hasContact->uname }}
                            </a>
                        </td>
                        <td>{{ $staff->hasProfession->profession }}</td>
                        <td class="text-center">
                            @can('delete')
                            <form method="POST" action="{{ route('admin.unlink.game') }}">
                                @csrf
                                <input type="hidden" name="relation_uuid" value="{{ $staff->uuid }}" />
                                @endcan
                                @can('update')
                                <a href="{{ route('admin.contact.edit', ['uuid' => $staff->hasContact->uuid]) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit" aria-hidden="true" title="@ucfirst(__('app.edit'))"></i>
                                </a>
                                @endcan
                                @can('delete')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash" aria-hidden="true" title="@ucfirst(__('app.delete'))"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if (count($game->inPodcasts) > 0)
        <h2 class="text-white">
            <i class="fas fa-podcast" aria-hidden="true" title="@ucfirst(__('app.episodesList'))"></i>
            @ucfirst(__('app.episodesList'))
            @can('update')
            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalPodcast">
                <i class="fas fa-link" aria-hidden="true" title="@ucfirst(__('app.podcastLink'))"></i>
                <span class="sr-only">@ucfirst(__('app.podcastLink'))</span>
            </button>
            @endcan
        </h2>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">@ucfirst(__('app.podcastName'))</th>
                        <th class="text-center">@ucfirst(__('app.episodeTitle'))</th>
                        <th class="text-center">@ucfirst(__('app.episodeAiredOn'))</th>
                        <th class="text-center">@ucfirst(__('app.episodeDuration'))</th>
                        <th class="text-center">@ucfirst(__('app.actions'))</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($game->inPodcasts as $episode)
                    <tr>
                        <td class="text-center">{{ $episode->id }}</td>
                        <td>
                            <a href="{{ route('admin.podcast.show', ['uuid' => $episode->inPodcast->uuid]) }}" class="text-white">
                                {{ $episode->inPodcast->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.episode.show', ['uuid' => $episode->uuid]) }}" class="text-white">
                                {{ $episode->title }}
                            </a>
                        </td>
                        <td class="text-center">
                            @if ($episode->aired_on)
                            @date($episode->aired_on)
                            @else
                            00/00/0000
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($episode->duration)
                            @time($episode->duration)
                            @else
                            00:00:00
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.episode.show', ['uuid' => $episode->uuid]) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-search" aria-hidden="true" title="@ucfirst(__('app.showData'))"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <div class="col-4">
        <div class="card mb-4">
            <h5 class="card-header">
                {{ $game->title }}
            </h5>
            <ul class="list-group list-group-flush">
                @if ($game->hasSerie)
                <a href="{{ route('admin.serie.show', ['uuid' => $game->hasSerie->serie_uuid]) }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-stream" aria-hidden="true" title="{{ $game->hasSerie->inSerie->serie }}"></i>
                    {{ $game->hasSerie->inSerie->serie }}
                </a>
                @else
                <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalSerieGameAdd">
                    <i class="fas fa-stream" aria-hidden="true" title="@ucfirst(__('app.gameSerieAdd'))"></i>
                    @ucfirst(__('app.gameSerieAdd'))
                </a>
                @endif
                @if ($game->studio_uuid)
                <a href="{{ route('admin.studio.show', ['uuid' => $game->studio_uuid]) }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-terminal" aria-hidden="true" title="@ucfirst(__('app.studio'))"></i>
                    {{ $game->createdBy->studio }}
                </a>
                @else
                <li class="list-group-item text-justify">
                    <i class="fas fa-terminal" aria-hidden="true" title="@ucfirst(__('app.studio'))"></i>
                    @ucfirst(__('app.studioUnknown'))
                </li>
                @endif
                <li class="list-group-item text-justify">
                    <i class="fas fa-calendar-check" aria-hidden="true" title="@ucfirst(__('app.gameDate'))"></i>
                    @if ($game->released_on)
                    @date($game->released_on)
                    @else
                    00/00/0000
                    @endif
                </li>
                @if ($game->mode)
                @foreach(json_decode($game->mode) as $mode)
                <li class="list-group-item text-justify">
                    <i class="fas fa-list-ol" aria-hidden="true" title="@ucfirst(__('app.gameMode'))"></i>
                    @ucfirst(__('app.game' . ucfirst($mode)))
                </li>
                @endforeach
                @else
                <li class="list-group-item text-justify">
                    ---
                </li>
                @endif
                @if ($game->hasGenres)
                @foreach($game->hasGenres as $genre)
                <a href="{{ route('admin.genre.show', ['uuid' => $genre->uuid]) }}"  class="list-group-item list-group-item-action">
                    <i class="fas fa-list-ul" aria-hidden="true" title="@ucfirst(__('app.gameMode'))"></i>
                    {{ $genre->genre }}
                </a>
                @endforeach
                @else
                <li class="list-group-item text-justify">
                    ---
                </li>
                @endif
                @if ($game->hasConsoles)
                <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalConsolesList">
                    <i class="fas fa-dice" aria-hidden="true" title="@ucfirst(__('app.consoles'))"></i>
                    @ucfirst(__('app.consolesList'))
                </a>
                @else
                <li class="list-group-item text-justify">
                    ---
                </li>
                @endif
            </ul>
            <div class="card-footer text-right">
                <small class="text-muted">{{ __('app.updatedAt') }} @datetime($game->updated_at)</small>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">
                <i class="fas fa-list-ol" aria-hidden="true" title="@ucfirst(__('app.links'))"></i>
                @ucfirst(__('app.sources'))
                @can('create')
                <div class="btn-toolbar mb-2 mb-md-0 float-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalSourceCreate">
                            <i class="fas fa-link" aria-hidden="true" title="@ucfirst(__('app.sourceStore'))"></i>
                            <span class="sr-only">@ucfirst(__('app.sourceStore'))</span>
                        </button>
                        <a href="{{ route('admin.source.index', ['uuid' => $game->uuid]) }}" role="button" class="btn btn-sm btn-info">
                            <i class="fas fa-search" aria-hidden="true" title="@ucfirst(__('app.sourceStore'))"></i>
                            <span class="sr-only">@ucfirst(__('app.sourceStore'))</span>
                        </a>
                    </div>
                </div>
                @endcan
            </h5>
            @if (count($game->hasLinks) > 0)
            <ul class="list-group list-group-flush">
                @foreach($game->hasLinks as $link)
                <a href="{{ $link->data }}" class="list-group-item list-group-item-action">
                    <i class="{{ $link->info->icon }}" aria-hidden="true" title="@ucfirst(__('app.' . $link->type))"></i>
                    @ucfirst(__('app.' . $link->type))
                </a>
                @endforeach
            </ul>
            <div class="card-footer text-right">
                <small class="text-muted">{{ __('app.updatedAt') }} @datetime($game->hasLinks->last()->updated_at)</small>
            </div>
            @endif
        </div>
    </div>
</div>

@if ($game->hasConsoles)
<div class="modal fade" id="modalConsolesList" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @ucfirst(__('app.consolesList'))
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    @foreach($game->hasConsoles as $console)
                    <a href="{{ route('admin.console.show', ['uuid' => $console->uuid]) }}" class="list-group-item list-group-item-action">
                        {{ $console->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
            </div>
        </div>
    </div>
</div>
@endif

@can('create')
@include('modals.serieGameAdd')
@include('modals.sourceGameCreate')
@include('modals.relationGameCreate')
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
});
$( function() {
    $("#serie_search").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.serie.autocomplete', ['s' => 'false', 'q']) !!}=" + request.term, function (data) {
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
                            label: value.serie,
                            value: value.serie
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#serie_uuid").val(ui.item.uuid);
		}
	});
});
</script>
@endsection
@endcan