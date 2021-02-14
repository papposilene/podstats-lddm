@extends('layouts.admin')
@section('title', @ucfirst(__('app.studiosList')))

@section('content')
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-terminal" aria-hidden="true"></i>
                    @ucfirst(__('app.studiosList'))
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    @can('create')
					<div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalStudioCreate">
                            <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.studioCreate'))"></i>
                            <span class="sr-only">@ucfirst(__('app.studioCreate'))</span>
                        </button>
                    </div>
					@endcan
					<form action="{{ route('admin.studio.search') }}" method="POST">
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
                
            {{ $studios->links() }}
            
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">
                                @ucfirst(__('app.studio'))
                                <span class="badge badge-pill badge-info float-right">
                                    <i class="fas fa-angle-down" aria-hidden="true" aria-label="@ucfirst(__('app.orderByAsc'))"></i>
                                </span>
                            </th>
                            <th class="text-center">@ucfirst(__('app.country'))</th>
                            <th class="text-center">@ucfirst(__('app.games'))</th>
                            <th class="text-center">@ucfirst(__('app.actions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studios as $studio)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $studio->studio }}</td>
                            <td>
                                {{ $studio->locatedAt->flag }}
                                {{ $studio->locatedAt->name_eng_common }}
                            </td>
                            <td class="text-center">{{ count($studio->hasGames) }}</td>
                            <td class="text-center">
                                @can('delete')
                                <form method="POST" action="{{ route('admin.studio.delete') }}">
                                    @csrf
                                    <input type="hidden" name="studio_uuid" value ="{{ $studio->uuid }}" />
                                    @endcan
                                    <a href="{{ route('admin.studio.show', ['uuid' => $studio->uuid]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search" aria-hidden="true" title="@ucfirst(__('app.showData'))"></i>
                                    </a>
                                    @can('delete')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash" aria-hidden="true" title="@ucfirst(__('app.delete'))"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

{{ $studios->links() }}

@can('create')
@include('modals.studioCreate')
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