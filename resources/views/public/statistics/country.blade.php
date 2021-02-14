@extends('layouts.app')
@section('title', @ucfirst(__('app.countriesStats')))

@section('content')
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.continentsStats'))</h1>
            <ul class="list-group list-group-flush">
                @foreach($continents_has_contacts as $key => $value)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ __('app.' . $key) }}</span>
                    <span class="badge badge-primary badge-pill">{{ $value }}</span>
                </li>
                @endforeach
            </ul>
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
            <h3 class="h5 card-header">@ucfirst(__('app.statCountriesTop10'))</h3>
            <div class="card-body">
                <canvas id="statsCountries" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-5">
    @foreach($regions_has_contacts as $ckey => $cvalue)
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">{{ __('app.' . $ckey) }}</h1>
            <div class="list-group list-group-flush">
                @foreach($cvalue as $rkey => $rvalue)
                @php
                $modal = str_replace(" ", "", $rkey);
                @endphp
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modal{{ $modal }}List">
                    <span>{{ __('app.' . $rkey) }}</span>
                    <span class="badge badge-primary badge-pill">{{ $rvalue }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>

@foreach($regions_has_contacts as $ckey => $cvalue)
@foreach($cvalue as $rkey => $rvalue)
@php
$modal = str_replace(" ", "", $rkey);
@endphp
<div class="modal fade" id="modal{{ $modal }}List" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal{{ $modal }}ListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal{{ $modal }}ListTitle">
                    {{ __('app.' . $rkey) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush mb-3">
                    @foreach($countries->whereStrict('subregion', $rkey) as $country)
                    <li class="list-group-item">
                        <span>{{ $country->flag }} {{ $country->name_eng_common }}</span><br />
                        @if (count($contacts->whereStrict('lives_at', $country->uuid)) > 0)
                        <a href="{{ route('public.contact.index', [ 'cca3' => $country->cca3]) }}">
                            <span>
                                @ucfirst(__('app.countryWithContacts', ['count' => count($contacts->whereStrict('lives_at', $country->uuid))]))
                            </span>
                        </a></br>
                        @else
                        <span class="text-muted">
                            @ucfirst(__('app.countryWithoutContact'))
                        </span><br />
                        @endif
                        @if (count($manufacturers->whereStrict('country_uuid', $country->uuid)) > 0)
                        <a href="{{ route('public.manufacturer.index', [ 'cca3' => $country->cca3]) }}">
                            <span>
                                @ucfirst(__('app.countryWithManufacturers', ['count' => count($manufacturers->whereStrict('country_uuid', $country->uuid))]))
                            </span>
                        </a></br>
                        @else
                        <span class="text-muted">
                            @ucfirst(__('app.countryWithoutManufacturer'))
                        </span><br />
                        @endif
                        @if (count($studios->whereStrict('country_uuid', $country->uuid)) > 0)
                        <a href="{{ route('public.studio.index', [ 'cca3' => $country->cca3]) }}">
                            <span>
                                @ucfirst(__('app.countryWithStudios', ['count' => count($studios->whereStrict('country_uuid', $country->uuid))]))
                            </span>
                        </a>
                        @else
                        <span class="text-muted">
                            @ucfirst(__('app.countryWithoutStudio'))
                        </span><br />
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach
@endsection

@section('js')
<script type="text/javascript">
$.getJSON("{{ route('api.episode.continents') }}", function (json) {
    var pieContinents = document.getElementById('statsContinents').getContext('2d');
    var arrContinents = $.makeArray( json.chart );
    var labels = $.map(arrContinents, function(item) {
        return item.labels;
    });
    var continents = $.map(arrContinents, function(item) {
        return item.data;
    });
    var chartContinents = new Chart(pieContinents, {
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
                position: 'bottom'
            }
        }
    });
});
$.getJSON("{{ route('api.contact.countries', ['count' => 10]) }}", function (json) {
    var pieCountries = document.getElementById('statsCountries').getContext('2d');
    var arrCountries = $.makeArray( json.chart );
    var labels = $.map(arrCountries, function(item) {
        return item.labels;
    });
    var countries = $.map(arrCountries, function(item) {
        return item.data;
    });
    var chartCountries = new Chart(pieCountries, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: countries,
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
var options = {
  valueNames: [ 'country-name' ]
};
var countriesList = new List('users', options);
</script>
@endsection