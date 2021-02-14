@extends('layouts.admin')
@section('title', @ucfirst(__('app.episodesList')))

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
        @ucfirst(__('app.episodesList'))
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('create')
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEpisodeCreate">
                <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.episodeCreate'))"></i>
                <span class="sr-only">@ucfirst(__('app.episodeCreate'))</span>
            </button>
        </div>
        @endcan
        <form action="{{ route('admin.episode.index') }}" method="POST">
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

{{ $episodes->links() }}

<div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">@ucfirst(__('app.podcast'))</th>
                            <th class="text-center">@ucfirst(__('app.episodeId'))</th>
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
                        @foreach($episodes as $episode)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('admin.podcast.show', ['uuid' => $episode->podcast_uuid]) }}" class="text-white">
                                    {{ $episode->inPodcast->name }}
                                </a>
                            </td>
                            <td class="text-center">{{ $episode->id }}</td>
                            <td class="text-center">{{ $episode->season }}</td>
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
                            <td class="text-center">{{ count($episode->hasContacts) }}</td>
                            <td class="text-center">{{ count($episode->hasTracklist) }}</td>
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
            
            {{ $episodes->links() }}
@endsection