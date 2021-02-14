@extends('layouts.app')
@section('title', $console->name)

@section('content')
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">{{ $console->name }}</h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <a href="{{ route('public.manufacturer.show', ['uuid' => $console->byManufacturer->uuid]) }}" class="text-white">
                            {{ $console->byManufacturer->company }}
                        </a>
                    </span>
                    <span class="float-right">{{ $console->byManufacturer->locatedAt->flag }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    @ucfirst(__('app.' . $console->type))
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statGameTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ count($console->hasGames) }}</span>
                </li>
            </ul>
            <form action="{{ route('public.game.search') }}" method="POST" class="card-body">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="@ucfirst(__('app.search'))" autocomplete="off" aria-label="@ucfirst(__('app.search'))">
                    <div class="input-group-append">
                        <button type="submit" class="btn bg-dark border border-secondary text-white">
                            <i class="fas fa-search" aria-hidden="true" aria-label="@ucfirst(__('app.search'))"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="card-footer text-center">
                <small class="text-muted">{{ __('app.updatedAt') }} @datetime($console->updated_at)</small>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header">@ucfirst(__('app.statGameTop10Genres'))</h3>
            <div class="card-body">
                <canvas id="statsGenres" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>

{{ $games->links() }}

<div class="row">
    @foreach($games->chunk(15) as $chunk)
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            @foreach($chunk as $game)
            <a href="{{ route('public.game.show', ['uuid' => $game->game_uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $game->hasGame->title }}</strong>, @if ($game->hasGame->released_on) @year($game->hasGame->released_on) @else 19?? @endif<br />
                    <em>{{ $game->hasGame->createdBy->locatedAt->flag }} {{ $game->hasGame->createdBy->studio }}</em>
                </span>
                <span class="badge badge-primary badge-pill">></span>
            </a>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

{{ $games->links() }}
@endsection

@section('js')
<script type="text/javascript">
$.getJSON("{{ route('api.console.genres', ['uuid' => $console->uuid, 'count' => 10]) }}", function (json) {
    var pieGenres = document.getElementById('statsGenres').getContext('2d');
    var arrGenres = $.makeArray( json.chart );
    var labels = $.map(arrGenres, function(item) {
        return item.labels;
    });
    var genres = $.map(arrGenres, function(item) {
        return item.data;
    });
    var chartGenres = new Chart(pieGenres, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: genres,
                    borderColor: '#000',
                    backgroundColor: [
                        '#b11312',
                        '#3490dc',
                        '#ffed4a',
                        '#38c172',
                        '#dc3545',
                        '#6cb2eb',
                        '#f6993f',
                        '#6574cd',
                        '#4dc0b5',
                        '#9561e2',
                        '#f66d9b'
                    ]
                }
            ]
        },
        options: {
            title: {
                display: false
            },
            label: {
                fontColor: '#fff'
            },
            legend: {
                align: 'start',
                display: true,
                position: 'bottom'
            }
        }
    });
});
</script>
@endsection