@extends('layouts.admin')
@section('title', @ucfirst(__('app.sourcesList')))

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        @ucfirst(__('app.sourcesList'))
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('create')
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalSourceTypeCreate">
                <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.sourceTypeCreate'))"></i>
                <span class="sr-only">@ucfirst(__('app.sourceTypeCreate'))</span>
            </button>
        </div>
        @endcan
        <form action="{{ route('admin.source.search') }}" method="POST">
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

{{ $sources->links() }}

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">@ucfirst(__('app.sourceItem'))</th>
                <th class="text-center">@ucfirst(__('app.sourceType'))</th>
                <th class="text-center">@ucfirst(__('app.sourceData'))</th>
                <th class="text-center">@ucfirst(__('app.actions'))</th>
            </tr>
        </thead>
        @foreach($sources as $source)
        <tbody>
            <tr>
                <td class="text-center">
                    {{ $loop->iteration }}
                </td>
                <td>
                    @if ($source->item_model === 'contact')
                    <a href="{{ route('admin.contact.show', ['uuid' => $source->item_uuid]) }}" class="text-white">
                        {{ $source->item_uuid }}
                    </a>
                    @elseif ($source->item_model === 'podcast')
                    <a href="{{ route('admin.podcast.show', ['uuid' => $source->item_uuid]) }}" class="text-white">
                        {{ $source->item_uuid }}
                    </a>
                    @elseif ($source->item_model === 'episode')
                    <a href="{{ route('admin.episode.show', ['uuid' => $source->item_uuid]) }}" class="text-white">
                        {{ $source->item_uuid }}
                    </a>
                    @elseif ($source->item_model === 'track')
                    <a href="{{ route('admin.track.show', ['uuid' => $source->item_uuid]) }}" class="text-white">
                        {{ $source->item_uuid }}
                    </a>
                    @else
                    {{ $source->item_uuid }}
                    @endif
                </td>
                <td>
                    <i class="{{ $source->info->icon }}" aria-hidden="true" title="@ucfirst(__('app.' . $source->type))"></i>
                    @ucfirst(__('app.' . $source->type))
                </td>
                <td>
                    <a href="{{ $source->data }}" class="text-white" target="_blank" rel="noopener">
                        {{ $source->data }}
                    </a>
                </td>
                <td class="text-center">
                    @can('delete')
                    <form method="POST" action="{{ route('admin.source.delete') }}">
                        @csrf
                        <input type="hidden" name="source_uuid" value ="{{ $source->uuid }}" />
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash" aria-hidden="true" aria-label="@ucfirst(__('app.delete'))"></i>
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
        </tbody>
		@endforeach
    </table>
</div>

{{ $sources->links() }}
@can('create')
@include('modals.sourceTypeCreate')
@endcan
@endsection