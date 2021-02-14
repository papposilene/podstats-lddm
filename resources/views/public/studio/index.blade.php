@extends('layouts.app')
@section('title', @ucfirst(__('app.studiosList')))

@section('content')
<div class="row row-cols-1 row-cols-md-2 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.studiosList'))</h1>
            <div class="list-group list-group-flush">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statStudioTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalStudios }}</span>
                </div>
                <a href="{{ route('public.game.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statGameTotal'))</span>
                    <span class="badge badge-primary badge-pill">{{ $totalGames }}</span>
                </a>
                <a href="{{ route('public.stats.studios') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statMore'))</span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
            </div>
            <form action="{{ route('public.studio.search') }}" method="POST" class="card-body">
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
            <h3 class="h5 card-header">@ucfirst(__('app.statStudioMap'))</h3>
            <div id="map" class="card-body leaflet-map"></div>
        </div>
    </div>
</div>

{{ $studios->links() }}

<div class="row">
    @foreach($studios->chunk(15) as $chunk)
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            @foreach($chunk as $studio)
            <a href="{{ route('public.studio.show', ['uuid' => $studio->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $studio->studio }}</strong><br />
                    <em>{{ $studio->locatedAt->flag }} {{ $studio->locatedAt->name_eng_common }}</em>
                </span>
                <span class="badge badge-primary badge-pill">{{ count($studio->hasGames) }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
            
{{ $studios->links() }}
@endsection

@section('js')
<script type="text/javascript">
var countries = $.ajax({
    url: "{{ route('api.studio.geojson') }}",
    dataType: "json",
    success: console.log("Studios data successfully loaded."),
    error: function(xhr) {
        alert(xhr.statusText)
    }
});

var map = L.map('map').setView([40, 0], 1);
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