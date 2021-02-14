@extends('layouts.admin')
@section('title', @ucfirst(__('app.professionsList')))

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-user-tie" aria-hidden="true"></i>
        @ucfirst(__('app.professionsList'))
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('create')
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalProfessionCreate">
                <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.professionCreate'))"></i>
                <span class="sr-only">@ucfirst(__('app.professionCreate'))</span>
            </button>
        </div>
        @endcan
        <form action="{{ route('admin.profession.index') }}" method="POST">
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
                <th class="text-center">@ucfirst(__('app.profession'))</th>
                <th class="text-center">@ucfirst(__('app.professionEpisode'))</th>
                <th class="text-center">@ucfirst(__('app.professionGame'))</th>
                <th class="text-center">@ucfirst(__('app.actions'))</th>
            </tr>
        </thead>
        <tbody>
            @foreach($professions as $profession)
            <tr>
                <td class="text-center">
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $profession->profession }}
                </td>
                <td class="text-center">
                    {{ count($profession->workAsInEpisode) }}
                </td>
                <td class="text-center">
                    {{ count($profession->workAsInGame) }}
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.profession.show', ['uuid' => $profession->uuid]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-search" aria-hidden="true" title="@ucfirst(__('app.professionLook'))"></i>
                        <span class="sr-only">@ucfirst(__('app.professionLook'))</span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@can('create')
@include('modals.professionCreate')
@endcan
@endsection