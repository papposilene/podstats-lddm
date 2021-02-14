@extends('layouts.admin')
@section('title', @ucfirst(__('app.trackEdit', ['track' => $track->title])))

@section('content')
<div class="row">
    <div class="col-8">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-white">
                {{ $track->title }}
            </h1>
        </div>

        <form method="POST" action="{{ route('admin.track.update') }}">
            @csrf
            <input type="hidden" name="contact_uuid" value="{{ $track->uuid }}" />

            <button type="submit" class="btn btn-primary mt-3 float-right">@ucfirst(__('app.trackUpdate'))</button>
        </form>
    </div>
    <div class="col-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h2 class="h2 text-white">
                <i class="fas fa-list-ol" aria-hidden="true" title="@ucfirst(__('app.dataLast'))"></i>
                @ucfirst(__('app.dataLast'))
            </h2>
        </div>

        @if (count($track->hasArtists) > 0)
        <div class="list-group list-group-flush">
            @foreach($track->hasArtists as $artist)
            <a href="{{ route('admin.contact.show', ['uuid' => $artist->composedBy->uuid]) }}" class="list-group-item list-group-item-action">
                {{ $artist->composedBy->uname }}
            </a>
            @break($loop->iteration == 5)
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection