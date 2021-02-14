@extends('layouts.app')
@section('title', $manufacturer->company)

@section('content')            
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">
                {{ $manufacturer->company }}
                <span class="float-right">{{ $manufacturer->locatedAt->flag }}</span>
            </h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statConsoleTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ count($manufacturer->hasConsoles) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statGameTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalGames }}</span>
                </li>
            </ul>
            <div id="map" class="card-body leaflet-map"></div>
            <p class="card-text text-center">
                <small class="text-muted">{{ __('app.updatedAt') }} @datetime($manufacturer->updated_at)</small>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header">@ucfirst(__('app.consolesList'))</h2>
            <ul class="list-group list-group-flush">
                @foreach($manufacturer->hasConsoles as $console)
                <a href="{{ route('public.console.show', ['uuid' => $console->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <strong>{{ $console->name }}</strong><br />
                        <em>{{ $console->released_on }}. @ucfirst(__('app.' . $console->type)).</em>
                    </span>
                    <span class="badge badge-primary badge-pill">{{ count($console->hasGames) }}</span>
                </a>
                @endforeach
            </ul>
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
</div>
@endsection

@section('js')
<script type="text/javascript">
@php
$latlng = json_decode($manufacturer->locatedAt->latlng, true);
@endphp
var map = L.map('map', { zoomControl: false }).setView([{{ $latlng['lng'] }}, {{ $latlng['lat'] }}], 1);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    tileSize: 512,
    zoomOffset: -1
}).addTo(map);
L.marker([{{ $latlng['lng'] }}, {{ $latlng['lat'] }}]).addTo(map);

$.getJSON("{{ route('api.manufacturer.consoles', ['uuid' => $manufacturer->uuid]) }}", function (json) {
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
</script>
@endsection