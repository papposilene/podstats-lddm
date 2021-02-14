@extends('layouts.admin')
@section('title', @ucfirst(__('app.genresList')))

@section('content')            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-list-alt" aria-hidden="true"></i>
                    @ucfirst(__('app.genresList'))
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    @can('create')
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalGenreCreate">
                            <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.genreCreate'))"></i>
                            <span class="sr-only">@ucfirst(__('app.genreCreate'))</span>
                        </button>
                    </div>
                    @endcan
                    <form action="{{ route('admin.genre.index') }}" method="POST">
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
                
            {{ $genres->links() }}
            
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">
                                @ucfirst(__('app.genres'))
                                <span class="badge badge-pill badge-info float-right">
                                    <i class="fas fa-angle-down" aria-hidden="true" aria-label="@ucfirst(__('app.orderByAsc'))"></i>
                                </span>
                            </th>
                            <th class="text-center">@ucfirst(__('app.games'))</th>
                            <th class="text-center">@ucfirst(__('app.actions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($genres as $genre)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $genre->genre }}</td>
                            <td class="text-center">
                                {{ count($genre->hasGames) }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.genre.show', ['uuid' => $genre->uuid]) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-search" aria-hidden="true" title="@ucfirst(__('app.genreLook'))"></i>
                                    <span class="sr-only">@ucfirst(__('app.genreLook'))</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $genres->links() }}

@can('create')
@include('modals.genreCreate')
@endcan
@endsection