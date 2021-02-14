<!-- Modal: modalTrackCreate -->
<div class="modal fade" id="modalTrackCreate" tabindex="-1" role="dialog" aria-labelledby="modalTrackCreateTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.track.store') }}" class="needs-validation" novalidate />
        @csrf
        <input type="hidden" name="podcast_uuid" id="podcast_uuid" value="{{ $episode->podcast_uuid }}" required />
        <input type="hidden" name="episode_uuid" id="episode_uuid" value="{{ $episode->uuid }}" required />
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTrackCreateTitle">@ucfirst(__('app.trackCreate'))</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_tid">
                                        &nbsp;<i class="fas fa-hashtag" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-primary" name="track_id" value="{{ $trackLastId + 1 }}" placeholder="@ucfirst(__('app.trackId'))" autocomplete="off" aria-label="@ucfirst(__('app.trackId'))" aria-describedby="form_tid" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border border-primary text-white" id="form_type">
                                        <i class="fas fa-audio-description" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <select class="form-control border border-primary" name="track_type" aria-describedby="form_type" required />
                                    <option value="actuality">@ucfirst(__('app.trackTypeActuality'))</option>
                                    <option value="cover">@ucfirst(__('app.trackTypeCover'))</option>
                                    <option value="guest">@ucfirst(__('app.trackTypeGuest'))</option>
                                    <option value="playlist">@ucfirst(__('app.trackTypeTracklist'))</option>
                                    <option value="other">@ucfirst(__('app.trackTypeOther'))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                &nbsp;<i class="fas fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <select class="form-control border border-primary" name="profession_uuid" required />
                            @foreach($professions as $profession)
                            <option value="{{ $profession->uuid }}">{{ $profession->profession }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control border border-primary" name="contact_uname" id="contact_search" placeholder="@ucfirst(__('app.trackAuthor'))" autocomplete="off" aria-label="@ucfirst(__('app.trackAuthor'))" aria-describedby="form_artist" required />
                        <input type="hidden" name="contact_uuid" id="contact_uuid" value="" / required />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-dice" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="studio_name" id="studio_search" placeholder="@ucfirst(__('app.studioName'))" autocomplete="off" aria-label="@ucfirst(__('app.trackAuthor'))" aria-describedby="form_artist" required />
                        <input type="hidden" name="studio_uuid" id="studio_uuid" value="" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-gamepad" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="game_title" id="game_search" placeholder="@ucfirst(__('app.gameTitle'))" aria-label="@ucfirst(__('app.gameTitle'))" aria-describedby="form_game" required />
                        <input type="hidden" name="game_uuid" id="game_uuid" value="" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                &nbsp;<i class="fas fa-audio-description" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="track_title" placeholder="@ucfirst(__('app.trackTitle'))" autocomplete="off" aria-label="@ucfirst(__('app.trackTitle'))" aria-describedby="form_title" required />
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border border-secondary text-white">
                                        &nbsp;<i class="fas fa-calendar-check" aria-hidden="true"></i>&nbsp;
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-secondary" name="track_date" placeholder="{{ __('app.ddmmyy') }}" aria-label="@ucfirst(__('app.trackDate'))" aria-describedby="form_date" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border border-secondary text-white">
                                        &nbsp;<i class="fas fa-clock" aria-hidden="true"></i>&nbsp;
                                    </span>
                                </div>
                                <input type="text" class="form-control border border-secondary" name="track_duration" placeholder="{{ __('app.hhmmss') }}" autocomplete="off" aria-label="@ucfirst(__('app.trackDuration'))" aria-describedby="form_date" /required/>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                &nbsp;<i class="fas fa-file-audio" aria-hidden="true"></i>&nbsp;
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="track_mbid" placeholder="@ucfirst(__('app.mbid'))" autocomplete="off" aria-label="@ucfirst(__('app.mbid'))" aria-describedby="form_mbid">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white">
                                &nbsp;<i class="fas fa-link" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="track_source" placeholder="@ucfirst(__('app.trackSource'))" autocomplete="off" aria-label="@ucfirst(__('app.trackSource'))" aria-describedby="form_source">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right">@ucfirst(__('app.trackStore'))</button>
                </div>
            </div>
        </div>
    </form>
</div>