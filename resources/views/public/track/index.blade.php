@extends('layouts.app')
@section('title', @ucfirst(__('app.tracksList')))

@section('content')
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card-body d-flex h-100">
                <h1 class="card-title text-center align-self-center w-100">@ucfirst(__('app.tracksList'))</h1>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="{{ route('public.contact.index') }}" class="list-group-item d-flex justify-content-between align-items-center">
                        <span>@ucfirst(__('app.statContactTotal'))</span>
                        <span class="badge badge-primary badge-pill">{{ $totalContacts }}</span>
                    </a>
                    <a href="{{ route('public.game.index') }}" class="list-group-item d-flex justify-content-between align-items-center">
                        <span>@ucfirst(__('app.statGameTotal'))</span>
                        <span class="badge badge-primary badge-pill">{{ $totalGames }}</span>
                    </a>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>@ucfirst(__('app.statTrackTotal'))</span>
                        <span class="badge badge-primary badge-pill">{{ $totalTracks }}</span>
                    </div>
                </div>
                <form action="{{ route('public.track.search') }}" method="POST" class="card-body">
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
        <div class="col-md-12">
            <nav class="nav nav-pills flex-column flex-sm-row mx-3 mb-3">
                <a href="{{ route('public.track.type', ['type' => 'actuality']) }}" class="flex-sm-fill text-sm-center nav-link">
                    @ucfirst(__('app.trackTypeActuality'))
                </a>
                <a href="{{ route('public.track.type', ['type' => 'tracklist']) }}" class="flex-sm-fill text-sm-center nav-link">
                    @ucfirst(__('app.trackTypeTracklist'))
                </a>
                <a href="{{ route('public.track.type', ['type' => 'guest']) }}" class="flex-sm-fill text-sm-center nav-link">
                    @ucfirst(__('app.trackTypeGuest'))
                </a>
                <a href="{{ route('public.track.type', ['type' => 'cover']) }}" class="flex-sm-fill text-sm-center nav-link">
                    @ucfirst(__('app.trackTypeCover'))
                </a>
            </nav>
        </div>
    </div>
</div>

{{ $tracks->links() }}            

<div class="row">
    @foreach($tracks->chunk(15) as $chunk)
    <div class="col-md-6 col-12">
        <div class="list-group list-group-flush">
            @foreach($chunk as $track)
            <a href="{{ route('public.track.show', ['uuid' => $track->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span>
                    {{ $track->title }}<br />
                    <em>{{ $track->hasGame->title }}, @if ($track->hasGame->released_on) @year($track->hasGame->released_on). @else 0000. @endif</em>
                </span>
                <span class="badge badge-primary badge-pill">></span>
            </a>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

{{ $tracks->links() }}
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