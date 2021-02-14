@extends('layouts.app')
@section('title', $game->title)

@section('content')
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <h1 class="card-title text-center">{{ $game->title }}</h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            @if ($game->released_on)
                            @date($game->released_on)
                            @else
                            00/00/0000
                            @endif
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            @if ($game->createdBy)
                            @if ($game->createdBy->locatedAt)
                            {{ $game->createdBy->locatedAt->flag }}
                            @else
                            @ucfirst(__('app.studioCountryUnknown'))
                            @endif
                            <a href="{{ route('public.studio.show', ['uuid' => $game->studio_uuid]) }}" class="text-white">
                                {{ $game->createdBy->studio }}
                            </a>
                            @else
                            @ucfirst(__('app.studioUnknown'))
                            @endif
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted">{{ __('app.updatedAt') }} @datetime($game->updated_at)</small>
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <p class="card-text">
                    <ol class="list-inline text-center">
                        @php
                        $modes = json_decode($game->mode, true);
                        @endphp
                        @foreach($modes as $mode)
                        <li class="list-inline-item">
                            @ucfirst(__('app.game' . ucfirst($mode)))
                        </li>
                        @endforeach
                    </ol>
                    <ol class="list-inline text-center">
                        @foreach($game->hasGenres as $genre)
                        <li class="list-inline-item">
                            <a href="{{ route('public.genre.show', ['uuid' => $genre->uuid]) }}" class="text-white">
                                {{ $genre->genre }}
                            </a>
                        </li>
                        @endforeach
                    </ol>
                    <ol class="list-inline text-center">
                        @foreach($game->hasConsoles as $console)
                        <li class="list-inline-item">
                            <a href="{{ route('public.console.show', ['uuid' => $console->uuid]) }}" class="text-white">
                                {{ $console->name }}
                            </a>
                        </li>
                        @endforeach
                    </ol>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-1">
    @if ($game->hasSerie)
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header">{{ $game->hasSerie->inSerie->serie }}</h2>
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    @ucfirst(__('app.achievementSerie'))
                </div>
                <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalSerie">
                    @php
                    $inEpisodes = $series->where('serie_uuid', $game->hasSerie->serie_uuid)->whereNotNull('game_uuid')->count();
                    $totalSerie = $series->where('serie_uuid', $game->hasSerie->serie_uuid)->count();
                    $seriePercent = round((($inEpisodes / $totalSerie) * 100), 2);
                    @endphp
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $seriePercent }}%;" aria-valuenow="{{ $seriePercent }}" aria-valuemin="0" aria-valuemax="100">{{ $seriePercent }}%</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endif

    @if (count($game->hasTracklist) > 0)
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header">@ucfirst(__('app.tracksList'))</h2>
            <ul class="list-group list-group-flush">
                @foreach($game->hasTracklist as $track)
                @foreach($track->inEpisodes as $episode)
                <a href="{{ route('public.track.show', ['uuid' => $episode->track_uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <strong>{{ $episode->hasTrack->title }}</strong>.<br />
                        <em>
                            @foreach($episode->hasComposers as $author)
                            {{ $author->composedBy->uname }}.
                            @endforeach
                        </em><br />
                        {{ $episode->hasEpisode->id }}. {{ $episode->hasEpisode->title }}, @date($episode->hasEpisode->aired_on).
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                @endforeach
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if (count($game->hasLinks) > 0)
    <div class="col">
        <div class="card">
            <h2 class="h5 card-header">@ucfirst(__('app.sourcesList'))</h2>
            <ul class="list-group list-group-flush">
                @foreach($game->hasLinks as $source)
                <a href="{{ $source->data }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="{{ $source->info->icon }}" aria-hidden="true" title="@ucfirst(__('app.' . $source->type))"></i>
                        @ucfirst(__('app.' . $source->type))
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
    
@if ($game->hasSerie)
<div class="modal fade" id="modalSerie" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalSerieTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSerieTitle">
                    {{ $game->hasSerie->inSerie->serie }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    @foreach ($series->where('serie_uuid', $game->hasSerie->serie_uuid)->sortBy('game_order') as $serie)
                    @if (filled($serie->game_uuid))
                    <a href="{{ route('public.game.show', ['uuid' => $serie->game_uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>{{ $serie->game_order }}. {{ $serie->game_title }}</span>
                        <span class="badge badge-success badge-pill">
                            <i class="fas fa-check"></i>
                        </span>
                    </a>
                    @else
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $serie->game_order }}. {{ $serie->game_title }}</span>
                        <span class="badge badge-danger badge-pill">
                            <i class="fas fa-times"></i>
                        </span>
                    </li>
                    @endif
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
@endsection