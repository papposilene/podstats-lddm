@extends('layouts.admin')
@section('title', @ucfirst(__('app.gamesList')))

@section('content')            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-gamepad" aria-hidden="true"></i>
                    @ucfirst(__('app.gamesList'))
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    @can('create')
                    <div class="btn-group mr-2">
						<a href="{{ route('admin.game.create') }}" role="button" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.gameCreate'))"></i>
                            <span class="sr-only">@ucfirst(__('app.gameCreate'))</span>
                        </a>
                    </div>
                    @endcan
                    <form action="{{ route('admin.game.index') }}" method="POST">
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
            
			{{ $games->links() }}
			
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">@ucfirst(__('app.studio'))</th>
                            <th class="text-center">
                                @ucfirst(__('app.title'))
                                <span class="badge badge-pill badge-info float-right">
                                    <i class="fas fa-angle-down" aria-hidden="true" aria-label="@ucfirst(__('app.orderByAsc'))"></i>
                                </span>
                            </th>
                            <th class="text-center">@ucfirst(__('app.releasedOn'))</th>
                            <th class="text-center">@ucfirst(__('app.actions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
								@if($game->createdBy)
								<a href="{{ route('admin.studio.show', ['uuid' => $game->createdBy->uuid]) }}">{{ $game->createdBy->studio }}</a>
								@else
								@ucfirst(__('app.studioUnknown'))
								@endif
							</td>
                            <td>
                                <a href="{{ route('admin.game.show', ['uuid' => $game->uuid]) }}" class="text-white">
                                    {{ $game->title }}
                                </a>
                            </td>
                            <td class="text-center">
                                @if($game->released_on)
                                @date($game->released_on)
                                @endif
                            </td>
                            <td class="text-center">
                                @can('delete')
                                <form method="POST" action="{{ route('admin.game.delete') }}">
                                    @csrf
                                    <input type="hidden" name="game_uuid" value ="{{ $game->uuid }}" />
                                    @endcan
                                    <a href="{{ route('admin.game.show', ['uuid' => $game->uuid]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                    </a>
                                    @can('update')
                                    <a href="{{ route('admin.game.edit', ['uuid' => $game->uuid]) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    @endcan
                                    @can('delete')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
			
			{{ $games->links() }}
@endsection