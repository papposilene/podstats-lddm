@extends('layouts.app')
@section('title', $track->title)

@section('content')
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col">
            <div class="card-body">
                <h1 class="card-title text-center">{{ $track->title }}</h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        @foreach($track->hasArtists as $contact)
                        <li class="list-inline-item">
                            <a href="{{ route('public.contact.show', ['uuid' => $contact->composedBy->uuid]) }}" class="text-white">
                                {{ $contact->composedBy->uname }}
                            </a>
                        </li>
                        @endforeach
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            @if ($track->released_on)
                            @date($track->released_on)
                            @else
                            00/00/0000
                            @endif
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted">{{ __('app.updatedAt') }} @datetime($track->updated_at)</small>
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="{{ route('public.game.show', ['uuid' => $track->hasGame->uuid]) }}" class="h4 text-white">
                                <em>{{ $track->hasGame->title }}</em>
                            </a>
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            @if ($track->hasGame->released_on)
                            @date($track->hasGame->released_on)
                            @else
                            00/00/0000
                            @endif
                        </li>
                        <li class="list-inline-item">
                            @if ($track->hasGame->createdBy)
                            @if ($track->hasGame->createdBy->locatedAt)
                            {{ $track->hasGame->createdBy->locatedAt->flag }}
                            @else
                            @ucfirst(__('app.studioCountryUnknown'))
                            @endif
                            <a href="{{ route('public.studio.show', ['uuid' => $track->hasGame->studio_uuid]) }}" class="text-white">
                                {{ $track->hasGame->createdBy->studio }}
                            </a>
                            @else
                            @ucfirst(__('app.studioUnknown'))
                            @endif
                        </li>
                        @if ($track->hasGame->mode)
                        @php
                        $modes = json_decode($track->hasGame->mode, true);
                        @endphp
                        @foreach($modes as $mode)
                        <li class="list-inline-item">
                            @ucfirst(__('app.game' . ucfirst($mode)))
                        </li>
                        @endforeach
                        @endif
                        @if ($track->hasGame->hasGenres)
                        @foreach($track->hasGame->hasGenres as $genre)
                        <li class="list-inline-item">
                            <a href="{{ route('public.genre.show', ['uuid' => $genre->uuid]) }}" class="text-white">
                                {{ $genre->genre }}
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ol>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-1">
    @if (count($track->inEpisodes) > 0)
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header">@ucfirst(__('app.tracksList'))</h2>
            <ul class="list-group list-group-flush">
                @foreach($track->inEpisodes as $episode)
                <a href="{{ route('public.episode.show', ['uuid' => $episode->episode_uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <em>{{ $episode->hasEpisode->inPodcast->name }}</em><br />
                        {{ $episode->hasEpisode->id }}. <strong>{{ $episode->hasEpisode->title }}</strong>, @date($episode->hasEpisode->aired_on).
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if (count($track->hasLinks) > 0)
    <div class="col">
        <div class="card">
            <h2 class="h5 card-header">@ucfirst(__('app.sourcesList'))</h2>
            <ul class="list-group list-group-flush">
                @foreach($track->hasLinks as $source)
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
@endsection