@extends('layouts.admin')
@section('title', $manufacturer->company)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        {{ $manufacturer->company }}
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('create')
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalConsoleCreate">
                <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.consoleCreate'))"></i>
                <span class="sr-only">@ucfirst(__('app.consoleCreate'))</span>
            </button>
        </div>
        @endcan
        <form action="{{ route('admin.manufacturer.search') }}" method="POST">
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
                    @ucfirst(__('app.releasedOn'))
                    <span class="badge badge-pill badge-info float-right">
                        <i class="fas fa-angle-up" aria-hidden="true" aria-label="@ucfirst(__('app.orderByDesc'))"></i>
                    </span>
                </th>
                <th class="text-center">@ucfirst(__('app.console'))</th>
                <th class="text-center">@ucfirst(__('app.type'))</th>
                <th class="text-center">@ucfirst(__('app.generation'))</th>
                <th class="text-center">@ucfirst(__('app.games'))</th>
                <th class="text-center">@ucfirst(__('app.actions'))</th>
            </tr>
        </thead>
        <tbody>
            @foreach($manufacturer->hasConsoles as $console)
            <tr>
                <td class="text-center">
                    {{ $loop->iteration }}
                </td>
                <td class="text-center">
                    {{ $console->released_on }}
                </td>
                <td>{{ $console->name }}</td>
                <td>@ucfirst(__('app.' . $console->type))</td>
                <td class="text-center">{{ $console->generation }}</td>
                <td class="text-center">{{ count($console->hasGames) }}</td>
                <td class="text-center">
                    @can('delete')
                    <form method="POST" action="{{ route('admin.console.delete') }}">
                        @csrf
                        <input type="hidden" name="console_uuid" value ="{{ $console->uuid }}" />
                        @endcan
                        <a href="{{ route('admin.console.show', ['uuid' => $console->uuid]) }}" class="btn btn-sm btn-primary">
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
@can('create')
@include('modals.consoleCreate')
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