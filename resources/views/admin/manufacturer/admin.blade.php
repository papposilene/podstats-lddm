@extends('layouts.admin')
@section('title', @ucfirst(__('app.manufacturersList')))

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        @ucfirst(__('app.manufacturersList'))
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
		@can('create')
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalManufacturerCreate">
                <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.manufacturerCreate'))"></i>
                <span class="sr-only">@ucfirst(__('app.manufacturerCreate'))</span>
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

{{ $manufacturers->links() }}

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">
                    @ucfirst(__('app.company'))
                    <span class="badge badge-pill badge-info float-right">
                        <i class="fas fa-angle-down" aria-hidden="true" aria-label="@ucfirst(__('app.orderByAsc'))"></i>
                    </span>
                </th>
                <th class="text-center">@ucfirst(__('app.manufacturerCountry'))</th>
                <th class="text-center">@ucfirst(__('app.consoles'))</th>
                <th class="text-center">@ucfirst(__('app.actions'))</th>
            </tr>
        </thead>
        @foreach($manufacturers as $manufacturer)
        <tbody>
            <tr>
                <td class="text-center">
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $manufacturer->company }}
                </td>
                <td>
                    {{ $manufacturer->locatedAt->flag }}&nbsp;
                    {{ $manufacturer->locatedAt->name_eng_common }}
                </td>
                <td class="text-center">
                    {{ count($manufacturer->hasConsoles) }}
                </td>
                <td class="text-center">
                    @can('delete')
                    <form method="POST" action="{{ route('admin.manufacturer.delete') }}">
                        @csrf
                        <input type="hidden" name="manufacturer_uuid" value ="{{ $manufacturer->uuid }}" />
                        @endcan
                        <a href="{{ route('admin.manufacturer.show', ['uuid' => $manufacturer->uuid]) }}" class="btn btn-sm btn-primary">
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
        </tbody>
		@endforeach
    </table>
</div>

{{ $manufacturers->links() }}
@can('create')
@include('modals.manufacturerCreate')
@endcan
@endsection

@can('create')
@section('js')
<script type="text/javascript">
$( function() {
    $("#countries").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.country.autocomplete', ['q']) !!}=" + request.term, function (data) {
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
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#country_uuid").val(ui.item.uuid);
		}
	});
});
</script>
@endsection
@endcan