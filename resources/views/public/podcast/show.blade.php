@extends('layouts.app')
@section('title', $podcast->name)

@section('content')                
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col-md-7">
            <div class="card-body">
                <h1 class="card-title text-center">{{ $podcast->name }}</h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <i class="fas fa-calendar-check" aria-hidden="true"></i>
                            @date($podcast->began_on)
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-calendar-times" aria-hidden="true"></i> 
                            @if($podcast->ended_on)
                            @date($podcast->ended_on)
                            @else
                            @ucfirst(__('app.podcastAiring'))
                            @endif
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-broadcast-tower" aria-hidden="true"></i> 
                            @ucfirst(__('app.episodeTotal', ['episode' => count($podcast->hasEpisodes)]))
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-clock" aria-hidden="true"></i> 
                            @php
                            $now = Carbon\Carbon::now();
                            $duration = Carbon\Carbon::now();
                            foreach ($podcast->hasEpisodes as $episode)
                            {
                                $time = $episode->duration;
                                $duration = $duration->subSeconds($time->second)->subMinutes($time->minute)->subHours($time->hour);
                            }
                            @endphp
                            {{ $now->shortAbsoluteDiffForHumans($duration, 3) }}
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-link" aria-hidden="true"></i> 
                            @if($podcast->hasSource)
                            <a href="{{ $podcast->hasSource->data }}" class="text-white" target="_blank" rel="noopener">
                                @ucfirst(__('app.podcastSource'))
                            </a>
                            @else
                            ---
                            @endif
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted">{{ __('app.updatedAt') }} @datetime($podcast->updated_at)</small>
                </p>
            </div>
        </div>
        <div class="col-md-5">
            <p class="p-4 text-justify">
                {{ $podcast->description }}
            </p>
        </div>
    </div>
</div>

{{ $episodes->links() }}
            
<div class="row">
    @foreach($episodes->chunk(15) as $chunk)
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            @foreach($chunk as $episode)
            @if (count($episode->hasTracklist) > 0)
            <a href="{{ route('public.episode.show', ['uuid' => $episode->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            @else
            <li class="list-group-item d-flex justify-content-between align-items-center">
            @endif
                <span>
                    <strong>{{ $episode->id }}. {{ $episode->title }}</strong><br />
                    <em>@ucfirst(__('app.seasonNb', ['season' => $episode->season])). @date($episode->aired_on). @time($episode->duration).</em>
                </span>
                <span class="badge badge-primary badge-pill">{{ count($episode->hasTracklist) }}</span>
            @if (count($episode->hasTracklist) > 0)
            </a>
            @else
            </li>
            @endif
            @endforeach
        </div>
    </div>
    @endforeach
</div>
            
{{ $episodes->links() }}
@endsection