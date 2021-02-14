@extends('layouts.admin')
@section('title', $podcast->name)

@section('content')
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-podcast" aria-hidden="true"></i>
                    {{ $podcast->name }}
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
					@can('update')
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalPodcastEdit">
                            <i class="fas fa-edit" aria-hidden="true" title="@ucfirst(__('app.podcastEdit', ['podcast' => $podcast->name]))"></i>
                            <span class="sr-only">@ucfirst(__('app.podcastUpdate'))</span>
                        </button>
                    </div>
					@endcan
					<form action="{{ route('admin.podcast.search') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="@ucfirst(__('app.search'))" aria-label="@ucfirst(__('app.search'))">
							<div class="input-group-append">
                                <button type="submit" class="btn-sm bg-dark border border-secondary text-white">
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
                                <i class="fas fa-calendar-check"></i> 
                                @date($podcast->began_on)
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-broadcast-tower"></i> 
                                @ucfirst(__('app.episodeTotal', ['episode' => count($podcast->hasEpisodes)]))
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-clock"></i>
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
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-calendar-check"></i>
                                @if($podcast->ended_on)
                                @date($podcast->began_on)
                                @else
                                @ucfirst(__('app.podcastAiring'))
                                @endif
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                
                            </p>
                        </div>
                        <div class="col-2">
                            <p class="text-white text-center">
                                <i class="fas fa-link"></i>
                                @if($podcast->hasSource)
                                <a href="{{ $podcast->hasSource->data }}" class="text-white" target="_blank" rel="noopener">
                                    @ucfirst(__('app.podcastSource'))
                                </a>
                                @else
                                -
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-white text-justify">
                                {{ $podcast->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                
            <h2 class="h4 text-white pt-3 pb-2">
                <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
                @ucfirst(__('app.episodesList'))
                <div class="btn-group mr-2 float-right">
                    @can('create')
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEpisodeCreate">
                            <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.episodeCreate'))"></i>
                            <span class="sr-only">@ucfirst(__('app.episodeCreate'))</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalEpisodeImport">
                            <i class="fas fa-file-import" aria-hidden="true" title="@ucfirst(__('app.episodeImport'))"></i>
                            <span class="sr-only">@ucfirst(__('app.episodeImport'))</span>
                        </button>
                    </div>
                    @endcan
                    <form action="{{ route('admin.episode.search') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="@ucfirst(__('app.search'))" aria-label="@ucfirst(__('app.search'))">
                            <div class="input-group-append">
                                <button type="submit" class="bg-dark btn-sm border border-secondary text-white">
                                    <i class="fas fa-search" aria-hidden="true" aria-label="@ucfirst(__('app.search'))"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </h2>
                
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">@ucfirst(__('app.season'))</th>
                            <th class="text-center">@ucfirst(__('app.episodeTitle'))</th>
                            <th class="text-center">
                                @ucfirst(__('app.episodeAiredOn'))
                                <span class="badge badge-pill badge-info float-right">
                                    <i class="fas fa-angle-up" aria-hidden="true" aria-label="@ucfirst(__('app.orderByDesc'))"></i>
                                </span>
                            </th>
                            <th class="text-center">@ucfirst(__('app.episodeDuration'))</th>
                            <th class="text-center">@ucfirst(__('app.episodeStaff'))</th>
                            <th class="text-center">@ucfirst(__('app.episodeTracks'))</th>
                            <th class="text-center">@ucfirst(__('app.actions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($podcast->hasEpisodes as $episode)
                        <tr>
                            <td class="text-center">{{ $episode->id }}</td>
                            <td class="text-center">{{ $episode->season }}</td>
                            <td>{{ $episode->title }}</td>
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
                            <td class="text-center">{{ count($episode->hasContacts) }}</td>
                            <td class="text-center">{{ count($episode->hasTracklist) }}</td>
                            <td class="text-center">
                                @can('delete')
                                <form method="POST" action="{{ route('admin.episode.delete') }}" class="">
                                    @csrf
                                    <input type="hidden" name="episode_uuid" value ="{{ $episode->uuid }}" />
                                    @endcan
                                    <a href="{{ route('admin.episode.show', ['uuid' => $episode->uuid]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                    </a>
                                    @can('delete')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
@can('update')
@include('modals.podcastUpdate')
@endcan
@can('create')
@include('modals.episodeCreate')
@include('modals.episodeImport')
@endcan
@endsection