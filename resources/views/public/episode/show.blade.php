@extends('layouts.app')
@section('title', $episode->title)

@section('content')
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <h2 class="h4 text-center"><a href="{{ route('public.podcast.show', ['uuid' => $episode->inPodcast->uuid]) }}" class="text-white"><em>{{ $episode->inPodcast->name }}</em></a></h2>
                <h1 class="card-title text-center">{{ $episode->title }}</h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <i class="fas fa-list-ol" aria-hidden="true"></i>
                            @ucfirst(__('app.seasonNb', ['season' => $episode->season]))
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-hashtag" aria-hidden="true"></i>
                            @ucfirst(__('app.episodeNb', ['episode' => $episode->id]))
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <i class="fas fa-calendar-check" aria-hidden="true"></i>
                            @if($episode->aired_on)
                            @date($episode->aired_on)
                            @else
                            00/00/0000
                            @endif
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-clock" aria-hidden="true"></i> 
                            @if($episode->duration)
                            @time($episode->duration)
                            @else
                            00:00:00
                            @endif
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-link" aria-hidden="true"></i> 
                            @if ($episode->hasSource)
                            <a href="{{ $episode->hasSource->data }}" class="text-white" target="_blank" rel="noopener">
                                @ucfirst(__('app.podcastSource'))
                            </a>
                            @else
                            ---
                            @endif
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted">{{ __('app.updatedAt') }} @datetime($episode->updated_at)</small>
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <p class="p-4 text-justify">
                {{ $episode->description }}
            </p>
        </div>
    </div>
</div>
                
<div class="row row-cols-1 row-cols-md-1">
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header">@ucfirst(__('app.statistics'))</h3>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modalContactsList">
                    <span>@ucfirst(__('app.statEpisodeContacts'))</span>
                    <span class="badge badge-primary badge-pill">{{ count($episode->hasContacts) }}</span>
                </a>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statEpisodeTracks'))</span>
                    <span class="badge badge-primary badge-pill">{{ count($episode->hasTracklist) }}</span>
                </div>
                <a href="{{ route('public.stats.episodes') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.podcastStats'))</span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <a href="{{ route('public.stats.seasons', ['season' => $episode->season]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.seasonStats', ['season' => $episode->season]))</span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3">
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
            <h3 class="h5 card-header">@ucfirst(__('app.statContinents'))</h3>
            <div class="card-body">
                <canvas id="statsContinents" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header">@ucfirst(__('app.statGenders'))</h3>
            <div class="card-body">
                <canvas id="statsGenders" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row row-cols-1 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.monthsStats'))</h1>
            <div class="card-body">
                <canvas id="statsMonths" width="100%" height="33%"></canvas>
            </div>
        </div>
    </div>
</div>
    
<div class="card">
    <h2 class="h4 card-header">@ucfirst(__('app.trackList'))</h2>
    <div class="list-group list-group-flush">
        @foreach($episode->hasTracklist as $track)
        <a href="{{ route('public.track.show', ['uuid' => $track->track_uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span>
                {{ $track->track_id }}. <strong>{{ $track->hasTrack->title }}</strong>.<br />
                @if ($track->hasGame->createdBy)
                {{ $track->hasGame->createdBy->locatedAt->flag }} {{ $track->hasGame->createdBy->studio }}, <em>{{ $track->hasGame->title }}</em>, @if ($track->hasGame->released_on) @year($track->hasGame->released_on)@endif.
                @endif
            </span>
            <span class="badge badge-secondary badge-pill">@ucfirst(__('app.trackType' . ucfirst($track->track_type)))</span>
        </a>
        @endforeach
    </div>
</div>

<div class="modal fade" id="modalContactsList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalContactsListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalContactsListTitle">
                    @ucfirst(__('app.contactsList'))
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    @foreach($episode->hasContacts as $staff)
                    <a href="{{ route('public.contact.show', ['uuid' => $staff->contact_uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>
                            {{ $staff->hasContact->uname }}</br />
                            <em>
                                @if ($staff->hasContact->livesAt) {{ $staff->hasContact->livesAt->flag }} {{ $staff->hasContact->livesAt->name_eng_common }}. @else @ucfirst(__('app.contactLivesAtUnknown')). @endif
                                @ucfirst($staff->hasProfession->profession).
                            </em>
                        </span>
                        <span class="float-right">
                            @if ($staff->hasContact->gender === 'band')
                            <i class="fas fa-users" title="@ucfirst(__('app.band'))" aria-hidden="true" aria-label="@ucfirst(__('app.band'))"></i>
                            @elseif ($staff->hasContact->gender === 'feminine')
                            <i class="fas fa-venus" title="@ucfirst(__('app.feminine'))" aria-hidden="true" aria-label="@ucfirst(__('app.feminine'))"></i>
                            @elseif ($staff->hasContact->gender === 'masculine')
                            <i class="fas fa-mars" title="@ucfirst(__('app.masculine'))" aria-hidden="true" aria-label="@ucfirst(__('app.masculine'))"></i>
                            @elseif ($staff->hasContact->gender === 'neutral')
                            <i class="fas fa-transgender-alt" title="@ucfirst(__('app.neutral'))" aria-hidden="true" aria-label="@ucfirst(__('app.neutral'))"></i>
                            @else
                            <i class="fas fa-genderless" title="@ucfirst(__('app.unknown'))" aria-hidden="true" aria-label="@ucfirst(__('app.unknown'))"></i>
                            @endif
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$.getJSON("{!! route('api.episode.genres', ['eid' => $episode->id, 'count' => 10]) !!}", function (json) {
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
$.getJSON("{{ route('api.episode.continents', ['eid' => $episode->id]) }}", function (json) {
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
$.getJSON("{{ route('api.episode.genders', ['eid' => $episode->id]) }}", function (json) {
    var pieGenders = document.getElementById('statsGenders').getContext('2d');
    var arrGenders = $.makeArray( json.chart );
    var labels = $.map(arrGenders, function(item) {
        return item.labels;
    });
    var genders = $.map(arrGenders, function(item) {
        return item.data;
    });
    var chartGender = new Chart(pieGenders, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: genders,
                    borderColor: '#000',
                    backgroundColor: [
                        '#ffce56',
                        '#f66d9b',
                        '#6cb2eb',
                        '#cc65fe',
                        '#adb5bd'
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
$.getJSON("{{ route('api.episode.months', ['eid' => $episode->id]) }}", function (json) {
    var pieMonths = document.getElementById('statsMonths').getContext('2d');
    var labMonths = $.makeArray( json.chart.labels );
    var births = $.makeArray( json.chart.datasets[0].data );
    var deaths = $.makeArray( json.chart.datasets[1].data );
    var games = $.makeArray( json.chart.datasets[2].data );
    var chartMonths = new Chart(pieMonths, {
        type: 'bar',
        data: {
            labels: labMonths,
            datasets: [{
                    label: '@ucfirst(__('app.birthsByMonth'))',
                    backgroundColor: '#adb5bd',
                    borderColor: '#000',
                    data: births
                },
                {
                    label: '@ucfirst(__('app.gamesByMonth'))',
                    backgroundColor: '#6c757d',
                    borderColor: '#000',
                    data: games
                },
                {
                    label: '@ucfirst(__('app.deathsByMonth'))',
                    backgroundColor: '#495057',
                    borderColor: '#000',
                    data: deaths
                }]
        },
        options: {
            responsive: true,
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
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});
</script>
@endsection