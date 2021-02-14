@extends('layouts.admin')
@section('title', @ucfirst(__('app.tracksList')))

@section('content')
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-music" aria-hidden="true"></i>
                    @ucfirst(__('app.tracksList'))
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <form action="{{ route('admin.track.index') }}" method="POST">
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
                
            {{ $tracks->links() }}
            
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">@ucfirst(__('app.trackTitle'))</th>
                            <th class="text-center">@ucfirst(__('app.trackDate'))</th>
                            <th class="text-center">@ucfirst(__('app.trackDuration'))</th>
                            <th class="text-center">@ucfirst(__('app.actions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tracks as $track)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $track->title }}</td>
                            <td class="text-center">
                                @if ($track->released_on)
                                @date($track->released_on)
                                @else
                                00/00/0000
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($track->duration)
                                @date($track->duration)
                                @else
                                00:00:00
                                @endif
                            </td>
                            <td class="text-center">
                                @can('delete')
                                <form method="POST" action="{{ route('admin.track.delete') }}" class="">
                                    @csrf
                                    <input type="hidden" name="track_uuid" value ="{{ $track->uuid }}" />
                                    @endcan
                                    @can('update')
                                    <a href="{{ route('admin.track.edit', ['uuid' => $track->uuid]) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('delete')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
</div>

{{ $tracks->links() }}
@endsection