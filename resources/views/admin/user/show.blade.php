@extends('layouts.admin')
@section('title', $user->uname)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        {{ $user->uname }}
    </h1>
    @if($user->hasRole('superAdmin') || ($user->uuid == Auth::user()->uuid))
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalUserUpdate">
                <i class="fas fa-file-import" aria-hidden="true" title="@ucfirst(__('app.userEdit', ['user' => $user->uname]))"></i>
                <span class="sr-only">@ucfirst(__('app.userEdit', ['user' => $user->uname]))</span>
            </button>
        </div>
    </div>
    @endif
</div>

@role('superAdmin')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3">
    <h3>@ucfirst(__('app.userPermission'))</h3>
    <form method="post" action="{{ route('admin.user.permission') }}">
        @csrf
        <input type="hidden" name="user_uuid" value="{{ $user->uuid }}" />
        <div class="form-group">
            <select class="form-control" id="formUserPermission">
                @foreach($roles as $role)
                <option value="{{ $role->id }}" @if($user->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">@ucfirst(__('app.save'))</button>
    </form>
</div>

{{ $activities->links() }}

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">@ucfirst(__('app.activityLogName'))</th>
                <th class="text-center">@ucfirst(__('app.menuCreatedAt'))</th>
                <th class="text-center">@ucfirst(__('app.activityDescription'))</th>
                <th class="text-center">@ucfirst(__('app.activitySId'))</th>
                <th class="text-center">@ucfirst(__('app.activitySType'))</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
            <tr>
                <td class="text-center">{{ $activity->id }}</td>
                <td>{{ $activity->log_name }}</td>
                <td>{{ $activity->created_at }}</td>
                <td>{{ $activity->description }}</td>
                <td>{{ $activity->subject_id }}</td>
                <td>{{ $activity->subject_type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $activities->links() }}
@endrole
@include('modals.userUpdate')
@endsection