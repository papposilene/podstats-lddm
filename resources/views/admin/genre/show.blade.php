@extends('layouts.admin')
@section('title', @ucfirst(__('app.genreLook', ['genre' => $genre->genre])))

@section('content')            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-list-alt" aria-hidden="true"></i>
                    {{ $genre->genre }}
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
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
                
            <h2 class="h4 text-white pt-3 pb-2">
                @ucfirst(__('app.gamesList'))
            </h2>
            <div class="table-responsive">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">@ucfirst(__('app.title'))</th>
                            <th class="text-center">@ucfirst(__('app.releasedOn'))</th>
                            <th class="text-center">@ucfirst(__('app.actions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($genre->hasGames as $game)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $game->title }}</td>
                            <td class="text-center">
                                @date($game->released_on)
                            </td>
                            <td class="text-center">
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
@endsection