@extends('layouts.app')
@section('title', @ucfirst(__('app.about')))

@section('content')
<div class="row row-cols-1 row-cols-md-2 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">
                @ucfirst(__('app.about'))
            </h5>
            <div class="card-body">
                        
            </div>
        </div>
    </div> 
                
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">
                @ucfirst(__('app.statistics'))
            </h5>
            <div class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-podcast" aria-hidden="true"></i>
                        @ucfirst(__('app.podcasts'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($podcasts) }}</span>
                </li>
                <a href="{{ route('public.episode.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
                        @ucfirst(__('app.episodes'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($episodes) }}</span>
                </a>
                <a href="{{ route('public.track.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-music" aria-hidden="true"></i>
                        @ucfirst(__('app.tracks'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($tracks) }}</span>
                </a>
                <a href="{{ route('public.contact.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-users" aria-hidden="true"></i>
                        @ucfirst(__('app.contacts'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($contacts) }}</span>
                </a>
                <a href="{{ route('public.manufacturer.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-industry" aria-hidden="true"></i>
                        @ucfirst(__('app.manufacturers'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($manufacturers) }}</span>
                </a>
                <a href="{{ route('public.console.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-dice" aria-hidden="true"></i>
                        @ucfirst(__('app.consoles'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($consoles) }}</span>
                </a>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-link" aria-hidden="true"></i>
                        @ucfirst(__('app.sources'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($sources) }}</span>
                </li>
                <a href="{{ route('public.studio.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-terminal" aria-hidden="true"></i>
                        @ucfirst(__('app.studios'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($studios) }}</span>
                </a>
                <a href="{{ route('public.genre.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-list-alt" aria-hidden="true"></i>
                        @ucfirst(__('app.genres'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($genres) }}</span>
                </a>
                <a href="{{ route('public.game.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-gamepad" aria-hidden="true"></i>
                        @ucfirst(__('app.games'))
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($games) }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection