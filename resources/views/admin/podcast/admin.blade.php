@extends('layouts.admin')
@section('title', @ucfirst(__('app.podcastsList')))

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-podcast" aria-hidden="true"></i>
        @ucfirst(__('app.podcastsList'))
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('create')
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalPodcastCreate">
                <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.podcastCreate'))"></i>
                <span class="sr-only">@ucfirst(__('app.podcastCreate'))</span>
            </button>
        </div>
        @endcan
        <form action="{{ route('admin.podcast.search') }}" method="POST">
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

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">
                    @ucfirst(__('app.podcastName'))
                    <span class="badge badge-pill badge-info float-right">
                        <i class="fas fa-angle-down" aria-hidden="true" aria-label="@ucfirst(__('app.orderByAsc'))"></i>
                    </span>
                </th>
                <th class="text-center">@ucfirst(__('app.podcastBeganOn'))</th>
                <th class="text-center">@ucfirst(__('app.podcastEndedOn'))</th>
                <th class="text-center">@ucfirst(__('app.actions'))</th>
            </tr>
        </thead>
        <tbody>
            @foreach($podcasts as $podcast)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $podcast->name }}</td>
                <td class="text-center">@date($podcast->began_on)</td>
                <td class="text-center">
                    @if($podcast->ended_on)
                    @date($podcast->ended_on)
                    @else
                    @ucfirst(__('app.podcastAiring'))
                    @endif
                </td>
                <td class="text-center">
                    @can('delete')
                    <form method="POST" action="{{ route('admin.podcast.delete') }}">
                        @csrf
                        <input type="hidden" name="podcast_uuid" value ="{{ $podcast->uuid }}" />
                        @endcan
                        <a href="{{ route('admin.podcast.show', ['uuid' => $podcast->uuid]) }}" class="btn btn-sm btn-primary">
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

@can('create')
<!-- Modal: modalPodcastCreate -->
<div class="modal fade" id="modalPodcastCreate" tabindex="-1" role="dialog" aria-labelledby="modalPodcastCreateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.podcast.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPodcastCreateTitle">@ucfirst(__('app.podcastCreate'))</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_name">
                                <i class="fas fa-podcast"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="podcast_name" placeholder="@ucfirst(__('app.podcastName'))" aria-label="@ucfirst(__('app.podcastName'))" aria-describedby="form_name">
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="formBeganOn">
                                        <i class="fas fa-calendar-check"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="podcast_beganOn" placeholder="1970-01-01" aria-label="@ucfirst(__('app.podcastBeganOn'))" aria-describedby="formBeganOn">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border border-secondary text-white" id="formEndedOn">
                                        <i class="fas fa-calendar-times"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-secondary" name="podcast_endedOn" placeholder="1990-01-01" aria-label="@ucfirst(__('app.podcastEndedOn'))" aria-describedby="formEndedOn">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                <i class="fas fa-audio-description"></i>
                            </span>
                        </div>
                        <textarea class="form-control border border-secondary" rows="7" name="podcast_description" placeholder="@ucfirst(__('app.podcastDescription'))" aria-label="@ucfirst(__('app.podcastDescription'))"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                <i class="fas fa-link"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="podcast_source" placeholder="@ucfirst(__('app.podcastSource'))" aria-label="@ucfirst(__('app.podcastSource'))" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_cover">
                                <i class="fas fa-image"></i>
                            </span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="podcast_cover" class="custom-file-input border border-primary" id="form_image" aria-describedby="form_cover" />
                            <label class="custom-file-label border border-primary" for="form_image">Choose file</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right">@ucfirst(__('app.podcastStore'))</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endcan
@endsection