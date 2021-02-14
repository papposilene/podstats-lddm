@extends('layouts.app')
@section('title', $lddm->name)

@section('content')
<div class="card mt-2 mb-3">
    <div class="card-body text-justify text-muted">
        Ce petit projet personnel intitulé <em>Podstats</em> n'existe que pour répondre à deux objectifs.
        Le premier consiste à permettre de faire un petit peu de statistiques et autres dataviz sur l'excellent podcast des <em>Démons du MIDI</em> :
        consoles ressorties, jeux vidéo présentés, artistes cités, bandes-sons explorées.
        Les honneurs dus à l'existence de ce podcast et de sa programmation doivent être rendu aux Césars que sont Gautoz, Pipomantis et Faskil, sans qui
        ce petit projet n'aurait pu voir le jour. Ce qui nous amène au second objectif, qui, quant à lui, est purement personnel : développer
        une application en faisant appel au framework Laravel pour le découvrir, l'appréhender et le maîtriser.
    </div>
</div>
<div class="card mt-2 mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{ $lddm->cover }}" class="card-img-top img-fluid rounded" alt="{{ $lddm->name }}" title="{{ $lddm->name }}">
        </div>
        <div class="col-md-8">
            <h1 class="card-header text-center">
                <a href="{{ route('public.podcast.show', ['uuid' => $lddm->uuid]) }}" class="text-white">
                    {{ $lddm->name }}
                </a>
            </h1>
            <div class="card-body">
                <ol class="list-inline text-center text-secondary">
                    <li class="list-inline-item">
                        <i class="fas fa-calendar-check" aria-hidden="true"></i>
                        @date($lddm->began_on)
                    </li>
                    <li class="list-inline-item">
                        <i class="fas fa-calendar-times" aria-hidden="true"></i> 
                        @if($lddm->ended_on)
                        @date($lddm->ended_on)
                        @else
                        @ucfirst(__('app.podcastAiring'))
                        @endif
                    </li>
                    <li class="list-inline-item">
                        <i class="fas fa-broadcast-tower" aria-hidden="true"></i> 
                        @ucfirst(__('app.episodeTotal', ['episode' => count($lddm->hasEpisodes)]))
                    </li>
                    <li class="list-inline-item">
                        <i class="fas fa-clock" aria-hidden="true"></i> 
                        @php
                        $now = Carbon\Carbon::now();
                        $duration = Carbon\Carbon::now();
                        foreach ($lddm->hasEpisodes as $episode)
                        {
                            $time = $episode->duration;
                            $duration = $duration->subSeconds($time->second)->subMinutes($time->minute)->subHours($time->hour);
                        }
                        @endphp
                        {{ $now->shortAbsoluteDiffForHumans($duration, 3) }}
                    </li>
                </ol>
                <p class="card-text">
                    {{ $lddm->description }}
                </p>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($lddm->hasEpisodes as $episode)
                @if (count($episode->hasTracklist) > 0)
                <a href="{{ route('public.episode.show', ['uuid' => $episode->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                @else
                <li class="list-group-item d-flex justify-content-between align-items-center">
                @endif
                    <span>
                        <strong>{{ $episode->id }}. {{ $episode->title }}</strong><br />
                        <em>@date($episode->aired_on). @time($episode->duration).</em>
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($episode->hasTracklist) }}</span>
                @if (count($episode->hasTracklist) > 0)
                </a>
                @else
                </li>
                @endif
                @break($loop->iteration == 6)
                @endforeach
                <a href="{{ route('public.podcast.show', ['uuid' => $lddm->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.episodesList'))...</span>
                    <span class="badge badge-primary badge-pill">{{ count($lddm->hasEpisodes) }}</span>
                </a>
            </ul>
        </div>
    </div>
</div>
@endsection