@extends('layouts.admin')
@section('title', $console->name)

@section('content')
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    {{ $console->name }}
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    @can('update')
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalConsoleUpdate">
                            <i class="fas fa-edit" aria-hidden="true" title="@ucfirst(__('app.consoleUpdate'))"></i>
                            <span class="sr-only">@ucfirst(__('app.consoleUpdate'))</span>
                        </button>
                    </div>
                    @endcan
                    <form action="{{ route('admin.console.search') }}" method="POST">
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
                
            <div class="row">
                <div class="col-8">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @ucfirst(__('app.gameTitle'))
                                        <span class="badge badge-pill badge-info float-right">
                                            <i class="fas fa-angle-down" aria-hidden="true" aria-label="@ucfirst(__('app.orderByAsc'))"></i>
                                        </span>
                                    </th>
                                    <th class="text-center">@ucfirst(__('app.gameDate'))</th>
                                    <th class="text-center">@ucfirst(__('app.actions'))</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($console->hasGames as $game)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $game->hasGame->title }}
                                    </td>
                                    <td class="text-center">
                                        @if ($game->hasGame->released_on)
                                        @date($game->hasGame->released_on)
                                        @else
                                        00/00/0000
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('delete')
                                        <form method="POST" action="{{ route('admin.unlink.game') }}">
                                            @csrf
                                            <input type="hidden" name="relation_uuid" value ="{{ $game->uuid }}" />
                                            @endcan
                                            <a href="{{ route('admin.game.show', ['uuid' => $game->uuid]) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-search" aria-hidden="true" aria-label="@ucfirst(__('app.show'))"></i>
                                            </a>
                                            @can('delete')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash" aria-hidden="true" aria-label="@ucfirst(__('app.delete'))"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="card mb-4">
                        <h5 class="card-header">
                            {{ $console->name }}
                        </h5>
                        <ul class="list-group list-group-flush">
                            <a href="{{ route('admin.manufacturer.show', ['uuid' => $console->manufacturer_uuid]) }}"  class="list-group-item list-group-item-action">
                                {{ $console->byManufacturer->company }}
                                <span class="float-right">{{ $console->byManufacturer->locatedAt->flag }}</span>
                            </a>
                            <li class="list-group-item text-justify">
                                <i class="fas fa-calendar-check" aria-hidden="true" title="@ucfirst(__('app.gameDate'))"></i>
                                @if ($console->released_on)
                                &nbsp;{{ $console->released_on }}
                                @else
                                &nbsp;0000
                                @endif
                            </li>
                            <li class="list-group-item text-justify">
                                <i class="fas fa-hashtag" aria-hidden="true" title="@ucfirst(__('app.consoleGeneration'))"></i>
                                @if ($console->generation)
                                &nbsp;{{ $console->generation }}
                                @else
                                &nbsp;---
                                @endif
                            </li>
                            <li class="list-group-item text-justify">
                                <i class="fas fa-laptop-house" aria-hidden="true" title="@ucfirst(__('app.consoleType'))"></i>
                                &nbsp;@ucfirst(__('app.' . $console->type))
                            </li>
                        </ul>
                        <div class="card-footer text-right">
                            <small class="text-muted">@datetime($console->updated_at)</small>
                        </div>
                    </div>
                </div>
            </div>
@can('update')
@include('modals.consoleUpdate')
@endcan
@endsection

@can('create')
@section('js')
<script type="text/javascript">
$(function() {
    $("#manufacturers").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.manufacturer.autocomplete', ['q']) !!}=" + request.term, function (data) {
                if(!data.length){
                    var result = [{
                        label: '@ucfirst(__('app.searchNotFound'))',
                        value: response.term
                    }];
                    response(result);
                }
                else
                {
                    response($.map(data, function (value, key) {
                        return {
                            uuid: value.uuid,
                            label: value.company,
                            value: value.company
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#manufacturer_uuid").val(ui.item.uuid);
		}
	});
});
</script>
@endsection
@endcan