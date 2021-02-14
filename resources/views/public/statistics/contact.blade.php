@extends('layouts.app')
@section('title', @ucfirst(__('app.statContact')))

@section('content')
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.statContact'))</h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statContactTotal'))</span>
                    <span>{{ count($contacts) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statContactDead'))</span>
                    <span>{{ count($contacts->whereNotNull('died_at')) }}</span>
                </li>
                <a href="{{ route('public.contact.index', ['gender' => 'band']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statContactGenderB'))</span>
                    <span>{{ count($contacts->whereStrict('gender', 'band')) }}</span>
                </a>
                <a href="{{ route('public.contact.index', ['gender' => 'feminine']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statContactGenderF'))</span>
                    <span>{{ count($contacts->whereStrict('gender', 'feminine')) }}</span>
                </a>
                <a href="{{ route('public.contact.index', ['gender' => 'masculine']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statContactGenderM'))</span>
                    <span>{{ count($contacts->whereStrict('gender', 'masculine')) }}</span>
                </a>
                <a href="{{ route('public.contact.index', ['gender' => 'neutral']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>@ucfirst(__('app.statContactGenderN'))</span>
                    <span>{{ count($contacts->whereStrict('gender', 'neutral')) }}</span>
                </a>
            </ul>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header">@ucfirst(__('app.statUnknown'))</h1>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modaGenderList">
                    <span>@ucfirst(__('app.statContactGenderUnknown'))</span>
                    <span>{{ count($contacts->where('gender', 'unknown')) }}</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modalLivesAtList">
                    <span>@ucfirst(__('app.statContactLivesAtUnknown'))</span>
                    <span>{{ count($contacts->whereNull('lives_at')) }}</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modalBirthOnList">
                    <span>@ucfirst(__('app.statContactBornOnUnknown'))</span>
                    <span>{{ count($contacts->whereNull('born_on')) }}</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modalBirthAtList">
                    <span>@ucfirst(__('app.statContactBornAtUnknown'))</span>
                    <span>{{ count($contacts->whereNull('born_at')) }}</span>
                </a>
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
            <h1 class="h5 card-header">@ucfirst(__('app.statContactTop20'))</h1>
            <ul class="list-group list-group-flush">
                @foreach($top20 as $eachOne)
                <li class="list-group-item">
                    <span>
                        #{{ $loop->iteration }}.
                        <strong><a href="{{ route('public.contact.show', ['uuid' => $eachOne->contact_uuid]) }}">{{ $eachOne->hasContact->uname }}</a></strong>,
                        {{ __('app.statContactDone', ['count' => $episodes->where('contact_uuid', $eachOne->contact_uuid)->count()]) }}
                    </span>
                    <ol class="list-inline text-secondary">
                        @foreach($episodes->sortByDesc('id')->where('contact_uuid', $eachOne->contact_uuid) as $eachEpisode)
                        <li class="list-inline-item">
                            #{{ $eachEpisode->hasEpisode->id }}.
                            <a href="{{ route('public.episode.show', ['uuid' => $eachEpisode->episode_uuid]) }}" class="text-secondary">{{ $eachEpisode->hasEpisode->title }}</a>
                            (@year($eachEpisode->hasEpisode->aired_on))
                        </li>
                        @endforeach
                    </ol>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="modaGenderList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modaGenderListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaGenderListTitle">
                    @ucfirst(__('app.statContactGenderUnknown'))
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush mb-3">
                    @foreach($contacts->where('gender', 'unknown') as $genderlessContact)
                    <a href="{{ route('public.contact.show', ['uuid' => $genderlessContact->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>{{ $genderlessContact->uname }}</span>
                        <span class="badge badge-primary badge-pill">></span>
                    </a>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalLivesAtList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLivesAtListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLivesAtListTitle">
                    @ucfirst(__('app.statContactLivesAtUnknown'))
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    @foreach($contacts->whereNull('lives_at') as $livesAtContact)
                    <a href="{{ route('public.contact.show', ['uuid' => $livesAtContact->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>{{ $livesAtContact->uname }}</span>
                        <span class="badge badge-primary badge-pill">></span>
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
<div class="modal fade" id="modalBirthOnList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalBirthOnListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBirthOnListTitle">
                    @ucfirst(__('app.statContactBornOnUnknown'))
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    @foreach($contacts->whereNull('born_on') as $bornAtContact)
                    <a href="{{ route('public.contact.show', ['uuid' => $bornAtContact->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>{{ $bornAtContact->uname }}</span>
                        <span class="badge badge-primary badge-pill">></span>
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
<div class="modal fade" id="modalBirthAtList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalBirthAtListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBirthAtListTitle">
                    @ucfirst(__('app.statContactBornAtUnknown'))
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    @foreach($contacts->whereNull('born_at') as $bornAtContact)
                    <a href="{{ route('public.contact.show', ['uuid' => $bornAtContact->uuid]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>{{ $bornAtContact->uname }}</span>
                        <span class="badge badge-primary badge-pill">></span>
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
$.getJSON("{{ route('api.contact.genders') }}", function (json) {
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
                position: 'right'
            }
        }
    });
});
</script>
@endsection