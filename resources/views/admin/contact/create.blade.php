@extends('layouts.admin')
@section('title', @ucfirst(__('app.contactCreate')))

@section('content')
<div class="row">
    <div class="col-8">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-white">
                @ucfirst(__('app.contactCreate'))
            </h1>
        </div>

        <form method="POST" action="{{ route('admin.contact.store') }}" class="needs-validation" novalidate />
			@csrf
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4">@ucfirst(__('app.detailsIdentity'))</h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_uname">
                        <i class="fas fa-user-secret" aria-hidden="true" title="@ucfirst(__('app.uname'))"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" name="contact_uname" placeholder="@ucfirst(__('app.uname'))" autocomplete="off" aria-label="@ucfirst(__('app.uname'))" aria-describedby="form_uname" required />
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_gender">
                                <i class="fas fa-transgender-alt" aria-hidden="true" title="@ucfirst(__('app.gender'))"></i>
                            </span>
                        </div>
                        <select class="form-control border border-primary" name="contact_gender" aria-label="@ucfirst(__('app.gender'))" aria-describedby="form_gender" required />
                            <option value="unknown">@ucfirst(__('app.gender'))</option>
                            <option value="band">@ucfirst(__('app.band'))</option>
                            <option value="feminine">@ucfirst(__('app.feminine'))</option>
                            <option value="masculine">@ucfirst(__('app.masculine'))</option>
                            <option value="neutral">@ucfirst(__('app.neutral'))</option>
                            <option value="unknown">@ucfirst(__('app.unknown'))</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_fname">
                                <i class="fas fa-user" aria-hidden="true" title="@ucfirst(__('app.fname'))"></i>
                                <span class="sr-only">@ucfirst(__('app.fname'))</span>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_fname" placeholder="@ucfirst(__('app.fname'))" autocomplete="off" aria-label="@ucfirst(__('app.fname'))" aria-describedby="form_fname" />
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_mname">
                                <i class="fas fa-user" aria-hidden="true" title="@ucfirst(__('app.mname'))"></i>
                                <span class="sr-only">@ucfirst(__('app.mname'))</span>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_mname" placeholder="@ucfirst(__('app.mname'))" autocomplete="off" aria-label="@ucfirst(__('app.mname'))" aria-describedby="form_mname">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_lname">
                                <i class="fas fa-user" aria-hidden="true" title="@ucfirst(__('app.lname'))"></i>
                                <span class="sr-only">@ucfirst(__('app.lname'))</span>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_lname" placeholder="@ucfirst(__('app.lname'))" autocomplete="off" aria-label="@ucfirst(__('app.lname'))" aria-describedby="form_lname">
                    </div>
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4">@ucfirst(__('app.detailsBiography'))</h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary border border-secondary text-white" id="form_livesAt">
                        <i class="fas fa-map-marked" aria-hidden="true" title="@ucfirst(__('app.livesAt'))"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-secondary" id="formLivesAt" placeholder="@ucfirst(__('app.livesAt'))" autocomplete="off" aria-label="@ucfirst(__('app.livesAt'))" aria-describedby="form_livesAt">
                <input type="hidden" name="contact_livesAt" id="contacFormLivesAt" value="" />
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_bornOn">
                                <i class="fas fa-calendar-check" aria-hidden="true" title="@ucfirst(__('app.bornOn'))"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_bornOn" placeholder="1970-01-01" autocomplete="off" aria-label="@ucfirst(__('app.bornOn'))" aria-describedby="form_bornOn">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_bornAt">
                                <i class="fas fa-globe" aria-hidden="true" title="@ucfirst(__('app.bornAt'))"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" id="formBornAt" placeholder="@ucfirst(__('app.bornAt'))" autocomplete="off" aria-label="@ucfirst(__('app.bornAt'))" aria-describedby="form_bornAt">
                        <input type="hidden" name="contact_bornAt" id="contactFormBornAt" value="" />
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_diedOn">
                                <i class="fas fa-calendar-times" aria-hidden="true" title="@ucfirst(__('app.diedOn'))"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_diedOn" placeholder="2000-12-31" autocomplete="off" aria-label="@ucfirst(__('app.diedOn'))" aria-describedby="form_diedOn">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_diedAt">
                                <i class="fas fa-globe" aria-hidden="true" title="@ucfirst(__('app.diedAt'))"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" id="formDiedAt" placeholder="@ucfirst(__('app.diedAt'))" autocomplete="off" aria-label="@ucfirst(__('app.diedAt'))" aria-describedby="form_diedAt">
                        <input type="hidden" name="contact_diedAt" id="contactFormDiedAt" value="" />
                    </div>
                </div>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary border border-secondary text-white">
                        <i class="fas fa-audio-description" aria-hidden="true" title="@ucfirst(__('app.biography'))"></i>
                    </span>
                </div>
                <textarea class="form-control border border-secondary" rows="10" name="contact_biography" placeholder="@ucfirst(__('app.biography'))" aria-label="@ucfirst(__('app.biography'))"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3 float-right">@ucfirst(__('app.contactStore'))</button>
        </form>
    </div>

    <div class="col-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h2 class="h2 text-white">
                <i class="fas fa-list-ol" aria-hidden="true" title="@ucfirst(__('app.dataLast'))"></i>
                @ucfirst(__('app.dataLast'))
            </h2>
        </div>

        <div class="list-group list-group-flush">
			@foreach($lastContacts as $lastContact)
            <a href="{{ route('admin.contact.show', ['uuid' => $lastContact->uuid]) }}" class="list-group-item list-group-item-action">
                {{ $lastContact->uname }}
            </a>
			@endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$( function() {
    $("#formLivesAt").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.country.autocomplete', ['q']) !!}=" + request.term, function (data) {
                if(!data.length){
                    var result = [{
                        label: '@ucfirst(__('app.searchNotFound'))',
                        value: response.term
                    }];
                    response(result);
                }
                else
                {
                    response($.map(data, function (value, key) {
                        return {
                            uuid: value.uuid,
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contacFormLivesAt").val(ui.item.uuid);
		}
	});
    $("#formNationality").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.country.autocomplete', ['q']) !!}=" + request.term, function (data) {
                if(!data.length){
                    var result = [{
                        label: '@ucfirst(__('app.searchNotFound'))',
                        value: response.term
                    }];
                    response(result);
                }
                else
                {
                    response($.map(data, function (value, key) {
                        return {
                            uuid: value.uuid,
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contactFormNationality").val(ui.item.uuid);
		}
	});
    $("#formBornAt").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.country.autocomplete', ['q']) !!}=" + request.term, function (data) {
                if(!data.length){
                    var result = [{
                        label: '@ucfirst(__('app.searchNotFound'))',
                        value: response.term
                    }];
                    response(result);
                }
                else
                {
                    response($.map(data, function (value, key) {
                        return {
                            uuid: value.uuid,
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contactFormBornAt").val(ui.item.uuid);
		}
	});
    $("#formDiedAt").autocomplete({
        source: function (request, response) {
            $.getJSON("{!! route('api.country.autocomplete', ['q']) !!}=" + request.term, function (data) {
                if(!data.length){
                    var result = [{
                        label: '@ucfirst(__('app.searchNotFound'))',
                        value: response.term
                    }];
                    response(result);
                }
                else
                {
                    response($.map(data, function (value, key) {
                        return {
                            uuid: value.uuid,
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
        minLength: 3,
        select: function( event, ui ) {
            $("#contactFormDiedAt").val(ui.item.uuid);
        }
	});
});
</script>
@endsection