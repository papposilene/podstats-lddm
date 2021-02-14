@extends('layouts.app')
@section('title', @ucfirst(__('app.consolesList')))

@section('content')
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.consolesList'))</h1>
            <form action="{{ route('public.console.search') }}" method="POST" class="card-body">
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
            <div class="list-group list-group-flush">
                <a href="{{ route('public.manufacturer.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statManufacturerTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalManufacturers }}</span>
                </a>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statConsoleTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalConsoles }}</span>
                </div>
                <a href="{{ route('public.game.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statGameTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalGames }}</span>
                </a>
                <a href="{{ route('public.stats.manufacturers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statMore'))</span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header">@ucfirst(__('app.statConsoleTypes'))</h3>
            <div class="card-body">
                <canvas id="statsConsoles" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">@ucfirst(__('app.statContinents'))</h5>
            <div class="card-body">
                <canvas id="statsContinents" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>

{{ $consoles->links() }}

<div class="row">
    @foreach($consoles->chunk(15) as $chunk)
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            @foreach($chunk as $console)
            <a href="{{ route('public.console.show', ['uuid' => $console->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $console->name }}</strong><br />
                    <em>{{ $console->byManufacturer->company }}, {{ $console->released_on }}. @ucfirst(__('app.' . $console->type)).</em>
                </span>
                <span class="badge badge-primary badge-pill">{{ count($console->hasGames) }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

{{ $consoles->links() }}
@endsection

@section('js')
<script type="text/javascript">
$.getJSON("{{ route('api.manufacturer.consoles') }}", function (json) {
    var pieConsoles = document.getElementById('statsConsoles').getContext('2d');
    var arrConsoles = $.makeArray( json.chart );
    var labels = $.map(arrConsoles, function(item) {
        return item.labels;
    });
    var consoles = $.map(arrConsoles, function(item) {
        return item.data;
    });
    var chartConsoles = new Chart(pieConsoles, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: consoles,
                    borderColor: '#000',
                    backgroundColor: [
                        '#3490dc',
                        '#9561e2',
                        '#dc3545',
                        '#f6993f',
                        '#38c172',
                        '#6cb2eb',
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
$.getJSON("{{ route('api.manufacturer.continents') }}", function (json) {
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
</script>
@endsection