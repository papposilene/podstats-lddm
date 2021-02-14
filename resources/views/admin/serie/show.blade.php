@extends('layouts.admin')
@section('title', $serie->serie)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-stream" aria-hidden="true"></i>
        {{ $serie->serie }}
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('create')
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalSerieGameCreate">
                <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.serieCreate'))"></i>
                <span class="sr-only">@ucfirst(__('app.serieCreate'))</span>
            </button>
        </div>
        @endcan
        <form action="{{ route('admin.serie.search') }}" method="POST">
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
                <th class="text-center">@ucfirst(__('app.serieName'))</th>
                <th class="text-center">
                    @ucfirst(__('app.serieOrder'))
                    <span class="badge badge-pill badge-info float-right">
                        <i class="fas fa-angle-down" aria-hidden="true" aria-label="@ucfirst(__('app.orderByAsc'))"></i>
                    </span>
                </th>
                <th class="text-center">@ucfirst(__('app.gameTitle'))</th>
                <th class="text-center">@ucfirst(__('app.gameExists'))</th>
                <th class="text-center">@ucfirst(__('app.actions'))</th>
            </tr>
        </thead>
        <tbody>
            @foreach($serie->hasGames as $game)
            <tr>
                <td class="text-center">
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $serie->serie }}
                </td>
                <td class="text-center">
                    {{ $game->game_order }}
                </td>
                <td>
                    @if ($game->game_uuid)
                    <a href="{{ route('admin.game.show', ['uuid' => $game->game_uuid]) }}" class="text-white">
                    @endif
                    {{ $game->game_title }}
                    @if ($game->game_uuid)
                    </a>
                    @endif
                </td>
                <td class="text-center">
                    @if ($game->game_uuid)
                    <i class="fas fa-check text-success aria-hidden="true" aria-label="@ucfirst(__('app.delete'))"></i>
                    @else
                    <i class="fas fa-times text-danger aria-hidden="true" aria-label="@ucfirst(__('app.delete'))"></i>
                    @endif
                </td>
                <td class="text-center">
                    @can('delete')
                    <form method="POST" action="{{ route('admin.serie.ungame') }}" class="">
                        @csrf
                        <input type="hidden" name="serie_uuid" value ="{{ $game->uuid }}" />
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
@can('create')
@include('modals.serieGameCreate')
@endcan
@endsection