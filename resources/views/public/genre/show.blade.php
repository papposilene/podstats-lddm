@extends('layouts.app')
@section('title', $genre->genre)

@section('content')
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.genresList'))</h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statGenreTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalGenres }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statStudioTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalStudios }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statGameTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalGames }}</span>
                </li>
            </ul>
            <form action="{{ route('public.genre.search') }}" method="POST" class="card-body">
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
            <h3 class="h5 card-header">@ucfirst(__('app.statContinents'))</h3>
            <div class="card-body">
                <canvas id="statsContinents" width="100%" height="100%"></canvas>
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

<div class="row">
    @foreach($games->chunk(15) as $chunk)
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            @foreach($chunk as $game)
            <a href="{{ route('public.game.show', ['uuid' => $game->hasGame->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $game->hasGame->title }}</strong><br />
                    @if ($game->hasGame->createdBy && $game->hasGame->released_on)
                    <em>{{ $game->hasGame->createdBy->locatedAt->flag }} {{ $game->hasGame->createdBy->studio }}, @year($game->hasGame->released_on).</em>
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
@endsection

@section('js')
<script type="text/javascript">
$.getJSON("{{ route('api.genre.continents', ['uuid' => $genre->uuid]) }}", function (json) {
    var pieContinents = document.getElementById('statsContinents').getContext('2d');
    var arrContinents = $.makeArray( json.chart );
    var labels = $.map(arrContinents, function(item) {
        return item.labels;
    });
    var continents = $.map(arrContinents, function(item) {
        return item.data;
    });
    var chartGender = new Chart(pieContinents, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: continents,
                    borderColor: '#000',
                    backgroundColor: [
                        '#000', // Africa
                        '#dc3545', // Americas
                        '#fff', // Antartic
                        '#ffed4a', // Asia
                        '#3490dc', // Europa
                        '#38c172', // Oceania
                        '#adb5bd' // Unknown
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
                position: 'right'
            }
        }
    });
});
$.getJSON("{{ route('api.genre.modes', ['uuid' => $genre->uuid]) }}", function (json) {
    var pieModes = document.getElementById('statsModes').getContext('2d');
    var arrModes = $.makeArray( json.chart );
    var labels = $.map(arrModes, function(item) {
        return item.labels;
    });
    var modes = $.map(arrModes, function(item) {
        return item.data;
    });
    var chartConsoles = new Chart(pieModes, {
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