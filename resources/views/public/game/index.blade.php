@extends('layouts.app')
@section('title', @ucfirst(__('app.gamesList')))

@section('content')
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.gamesList'))</h1>
            <div class="list-group list-group-flush">
                <a href="{{ route('public.studio.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statStudioTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalStudios }}</span>
                </a>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statGameTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalGames }}</span>
                </div>
                <a href="{{ route('public.console.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statConsoleTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalConsoles }}</span>
                </a>
            </div>
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
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header">@ucfirst(__('app.statModes'))</h3>
            <div class="card-body">
                <canvas id="statsModes" width="100%" height="100%"></canvas>
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
            <a href="{{ route('public.game.show', ['uuid' => $game->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $game->title }}</strong><br />
                    @if ($game->createdBy && $game->released_on)
                    <em>{{ $game->createdBy->locatedAt->flag }} {{ $game->createdBy->studio }}, @year($game->released_on).</em>
                    @else
                    <em>@ucfirst(__('app.studioUnknown')).</em>
                    @endif
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
$.getJSON("{{ route('api.game.genres', ['count' => 10]) }}", function (json) {
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
$.getJSON("{{ route('api.game.modes') }}", function (json) {
    var pieModes = document.getElementById('statsModes').getContext('2d');
    var arrModes = $.makeArray( json.chart );
    var labels = $.map(arrModes, function(item) {
        return item.labels;
    });
    var modes = $.map(arrModes, function(item) {
        return item.data;
    });
    var chartModes = new Chart(pieModes, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: modes,
                    borderColor: '#000',
                    backgroundColor: [
                        '#f66d9b',
                        '#6cb2eb',
                        '#cc65fe',
                        '#ffce56'
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