@extends('layouts.app')
@section('title', @ucfirst(__('app.seasonsStats')))

@section('content')
<div class="row row-cols-1 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.seasonsStats'))</h1>
            <div class="list-group list-group-flush">
                <a href="{{ route('public.stats.episodes') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        @ucfirst(__('app.podcastStats'))
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                @foreach($seasons as $season)
                <a href="{{ route('public.stats.seasons', ['season' => $season->season]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        @ucfirst(__('app.seasonStats', ['season' => $season->season]))
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection