@extends('layouts.admin')
@section('title', @ucfirst(__('app.usersList')))

@section('content')

            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-white">
                    <i class="fas fa-users" aria-hidden="true"></i>
                    @ucfirst(__('app.usersList'))
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalUserInvite">
                        <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.userInvite'))"></i>
                        <span>@ucfirst(__('app.userInvite'))</span>
                    </button>
                </div>
            </div>
            
            {{ $users->links() }}
                
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">@ucfirst(__('app.uname'))</th>
                            <th class="text-center">@ucfirst(__('app.role'))</th>
                            <th class="text-center">@ucfirst(__('app.actions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $user->uname }}</td>
                            <td>{{ $user->roles->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.user.show', ['uuid' => $user->uuid]) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-search" aria-hidden="true" title="@ucfirst(__('app.userLook', ['user' => $user->uname]))"></i>
                                    <span class="sr-only">@ucfirst(__('app.userLook', ['user' => $user->uname]))</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

<!-- Modal: modalUserInvite -->
<div class="modal fade" id="modalUserInvite" tabindex="-1" role="dialog" aria-labelledby="modalUserInviteTitle" aria-hidden="true">
    <form method="POST" action="{{ route('admin.invite.process') }}">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserInviteTitle">@ucfirst(__('app.userInvite'))</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text bg-primary border border-primary text-white" id="invite-email">
								<i class="fas fa-at" aria-hidden="true" title="@ucfirst(__('app.userInvite'))"></i>
							</span>
						</div>
						<input type="text" class="form-control border border-primary" name="email" autocomplete="off" placeholder="@ucfirst(__('app.email'))" aria-label="@ucfirst(__('app.email'))" aria-describedby="invite-email">
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@ucfirst(__('app.close'))</button>
                    <button type="submit" class="btn btn-primary">@ucfirst(__('app.userInvited'))</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection 