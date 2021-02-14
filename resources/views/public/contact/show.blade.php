@extends('layouts.app')
@section('title', $contact->uname)

@section('content')
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col">
            <div class="card-body">
                <h1 class="card-title text-center">{{ $contact->uname }}</h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            @if ($contact->fname)
                            {{ $contact->fname }}
                            @endif
                            @if ($contact->mname)
                            {{ $contact->mname }}
                            @endif
                            @if ($contact->lname)
                            {{ $contact->lname }}
                            @endif
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            @if ($contact->gender === 'band')
                            <i class="fas fa-users" title="@ucfirst(__('app.band'))" aria-hidden="true" aria-label="@ucfirst(__('app.band'))"></i>
                            @elseif ($contact->gender === 'feminine')
                            <i class="fas fa-venus" title="@ucfirst(__('app.feminine'))" aria-hidden="true" aria-label="@ucfirst(__('app.feminine'))"></i>
                            @elseif ($contact->gender === 'masculine')
                            <i class="fas fa-mars" title="@ucfirst(__('app.masculine'))" aria-hidden="true" aria-label="@ucfirst(__('app.masculine'))"></i>
                            @elseif ($contact->gender === 'neutral')
                            <i class="fas fa-transgender-alt" title="@ucfirst(__('app.neutral'))" aria-hidden="true" aria-label="@ucfirst(__('app.neutral'))"></i>
                            @else
                            <i class="fas fa-genderless" title="@ucfirst(__('app.unknown'))" aria-hidden="true" aria-label="@ucfirst(__('app.unknown'))"></i>
                            @endif
                        </li>
                        <li class="list-inline-item">
                            @if ($contact->livesAt)
                            {{ $contact->livesAt->flag }} {{ $contact->livesAt->name_eng_common }}
                            @else
                            @ucfirst(__('app.contactLivesAtUnknown'))
                            @endif
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            @if ($contact->born_on)
                            @date($contact->born_on)
                            @if ($contact->bornAt) @ {{ $contact->bornAt->name_eng_common }}. @else @ @ucfirst(__('app.contactBornAtUnknown')). @endif
                            @endif
                        </li>
                        <li class="list-inline-item">
                            @if ($contact->died_on)
                            @date($contact->died_on)
                            @if ($contact->diedAt) @ {{ $contact->diedAt->name_eng_common }}. @else @ @ucfirst(__('app.contactDiedAtUnknown')). @endif
                            @endif
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted">{{ __('app.updatedAt') }} @datetime($contact->updated_at)</small>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header">@ucfirst(__('app.statGameTop10Studios'))</h3>
            <div class="card-body">
                <canvas id="statsStudios" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header">@ucfirst(__('app.statGameTop10Consoles'))</h3>
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
</div>

<div class="row row-cols-1 row-cols-md-1">
    @if (count($contact->hasTracks) > 0)
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header">@ucfirst(__('app.tracksList'))</h2>
            <div class="list-group list-group-flush">
                @foreach($contact->hasTracks as $track)
                <a href="{{ route('public.episode.show', ['uuid' => $track->track_uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        {{ $track->inEpisode->hasEpisode->id }}. <strong>{{ $track->inEpisode->hasEpisode->title }}</strong>, @date($track->inEpisode->hasEpisode->aired_on).<br />
                        {{ $track->composedFor->title }}, <em>{{ $track->hasComposed->title }}</em>, @if ($track->composedFor->released_on) @year($track->composedFor->released_on)@endif.<br />
                        <em>
                            @if ($track->composedFor->studio_uuid)
                            {{ $track->composedFor->createdBy->locatedAt->flag }} {{ $track->composedFor->createdBy->studio }}.
                            @else
                            @ucfirst(__('app.studioUnknown')).
                            @endif
                        </em>
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if (count($contact->hasLinks) > 0)
    <div class="col">
        <div class="card">
            <h2 class="h5 card-header">@ucfirst(__('app.sourcesList'))</h2>
            <div class="list-group list-group-flush">
                @foreach($contact->hasLinks as $source)
                <a href="{{ $source->data }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="{{ $source->info->icon }}" aria-hidden="true" title="@ucfirst(__('app.' . $source->type))"></i>
                        @ucfirst(__('app.' . $source->type))
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('js')
<script type="text/javascript">
$.getJSON("{{ route('api.contact.studios', ['uuid' => $contact->uuid, 'count' => 10]) }}", function (json) {
    var pieStudios = document.getElementById('statsStudios').getContext('2d');
    var arrStudios = $.makeArray( json.chart );
    var labels = $.map(arrStudios, function(item) {
        return item.labels;
    });
    var studios = $.map(arrStudios, function(item) {
        return item.data;
    });
    var chartStudios = new Chart(pieStudios, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: studios,
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
$.getJSON("{{ route('api.contact.consoles', ['uuid' => $contact->uuid, 'count' => 10]) }}", function (json) {
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
$.getJSON("{{ route('api.contact.genres', ['uuid' => $contact->uuid, 'count' => 10]) }}", function (json) {
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