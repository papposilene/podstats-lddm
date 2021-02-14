@extends('layouts.app')
@section('title', @ucfirst(__('app.statGame')))

@section('content')
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header">@ucfirst(__('app.statGameTop10Consoles'))</h5>
            <div class="card-body">
                <canvas id="statsConsoles" width="100%" height="100%"></canvas>
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
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header">@ucfirst(__('app.statModes'))</h3>
            <div class="card-body">
                <canvas id="statsModes" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.statGameTop20'))</h1>
            <div class="list-group list-group-flush">
                <a href="{{ route('public.game.index') }}" class="bg-info list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statGameTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ count($games) }}</span>
                </a>
                @foreach($top20Games as $eachGame)
                <a href="{{ route('public.game.show', ['uuid' => $eachGame->game_uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        #{{ $loop->iteration }}.
                        <strong>{{ $eachGame->hasGame->title }}</strong>.<br />
                        <em>{{ $eachGame->hasGame->createdBy->studio }}, {{ $eachGame->hasGame->createdBy->locatedAt->flag }} {{ $eachGame->hasGame->createdBy->locatedAt->name_eng_common }}.</em>
                    </span>
                    <span class="badge badge-primary badge-pill">{{ $eachGame->game_count }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>    
@endsection

@section('js')
<script type="text/javascript">
$.getJSON("{{ route('api.console.consoles', ['count' => 10]) }}", function (json) {
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

var countries = $.ajax({
    url: "{{ route('api.studio.geojson') }}",
    dataType: "json",
    success: console.log("Studios data successfully loaded."),
    error: function(xhr) {
        alert(xhr.statusText)
    }
});

var map = L.map('map').setView([40, 0], 2);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    tileSize: 512,
    zoomOffset: -1
}).addTo(map);

$.when(countries).done(function() {
    // Add requested external GeoJSON to map
    var kyCountries = L.geoJSON(countries.responseJSON, {
        onEachFeature: onEachFeature
    }).addTo(map);
});

function onEachFeature(feature, layer) {
    if (feature.properties) {
        layer.bindPopup('<h5>' + feature.properties.studio + '</h5>' +
        '<ul class="list-unstyled">' +
        '<li>' + feature.properties.flag + ' ' + feature.properties.name_common + '</li>' +
        '</ul>');
    }
}
</script>
@endsection