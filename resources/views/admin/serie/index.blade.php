@extends('layouts.admin')
@section('title', @ucfirst(__('app.seriesList')))

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-stream" aria-hidden="true"></i>
        @ucfirst(__('app.seriesList'))
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('create')
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalSerieCreate">
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

{{ $series->links() }}

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">
                    @ucfirst(__('app.serieName'))
                    <span class="badge badge-pill badge-info float-right">
                        <i class="fas fa-angle-down" aria-hidden="true" aria-label="@ucfirst(__('app.orderByAsc'))"></i>
                    </span>
                </th>
                <th class="text-center">@ucfirst(__('app.serieCount'))</th>
                <th class="text-center">@ucfirst(__('app.actions'))</th>
            </tr>
        </thead>
        <tbody>
            @foreach($series as $serie)
            <tr>
                <td class="text-center">
                    {{ $loop->iteration }}
                </td>
                <td>
                    <a href="{{ route('admin.serie.show', ['uuid' => $serie->uuid]) }}">
                        {{ $serie->serie }}
                    </a>
                </td>
                <td class="text-center">
                    {{ count($serie->hasGames) }}
                </td>
                <td class="text-center">
                    @can('delete')
                    <form method="POST" action="{{ route('admin.serie.delete') }}" class="">
                        @csrf
                        <input type="hidden" name="serie_uuid" value ="{{ $serie->uuid }}" />
                        <a href="{{ route('admin.serie.show', ['uuid' => $serie->uuid]) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </a>
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
    
{{ $series->links() }}
@can('create')
@include('modals.serieCreate')
@endcan
@endsection