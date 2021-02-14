@extends('layouts.admin')
@section('title', @ucfirst(__('app.activityLog')))

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-clipboard-list" aria-hidden="true"></i>
        @ucfirst(__('app.activityLog'))
    </h1>
</div>

{{ $activities->links() }}

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">@ucfirst(__('app.activityLogName'))</th>
                <th class="text-center">@ucfirst(__('app.menuCreatedAt'))</th>
                <th class="text-center">@ucfirst(__('app.activityCId'))</th>
                <th class="text-center">@ucfirst(__('app.activityCType'))</th>
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
                <td>
                    <a href="{{ route('admin.user.show', ['uuid' => $activity->causer_id]) }}" class="text-white">
                        {{ $activity->causer_id }}
                    </a>
                </td>
                <td>{{ $activity->causer_type }}</td>
                <td>{{ $activity->description }}</td>
                <td>{{ $activity->subject_id }}</td>
                <td>{{ $activity->subject_type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $activities->links() }}
@endsection