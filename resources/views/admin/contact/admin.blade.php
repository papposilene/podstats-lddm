@extends('layouts.admin')
@section('title', @ucfirst(__('app.contactsList')))

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-address-book" aria-hidden="true"></i>
        @ucfirst(__('app.contactsList'))
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('create')
        <div class="btn-group mr-2">
            <a href="{{ route('admin.contact.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus" aria-hidden="true" title="@ucfirst(__('app.contactCreate'))"></i>
                <span class="sr-only">@ucfirst(__('app.contactCreate'))</span>
            </a>
        </div>
        @endcan
        <form action="{{ route('admin.contact.index') }}" method="POST">
            @csrf
            <div class="input-group input-group-sm">
                <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="@ucfirst(__('app.search'))" aria-label="@ucfirst(__('app.search'))">
                <div class="input-group-append">
                    <button type="submit" class="bg-dark border border-secondary btn-sm text-white">
                        <i class="fas fa-search" aria-hidden="true" aria-label="@ucfirst(__('app.search'))"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{ $contacts->links() }}

<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">@ucfirst(__('app.uname'))</th>
                <th class="text-center">
                    @ucfirst(__('app.lname'))
                    <span class="badge badge-pill badge-info float-right">
                        <i class="fas fa-angle-down" aria-hidden="true" aria-label="@ucfirst(__('app.orderByAsc'))"></i>
                    </span>
                </th>
                <th class="text-center">@ucfirst(__('app.fname'))</th>
                <th class="text-center">@ucfirst(__('app.livesAt'))</th>
                <th class="text-center">@ucfirst(__('app.gender'))</th>
                <th class="text-center">@ucfirst(__('app.actions'))</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ route('admin.contact.show', ['uuid' => $contact->uuid]) }}" class="text-white">
                        {{ $contact->uname }}
                    </a>
                </td>
                <td>{{ $contact->lname }}</td>
                <td>{{ $contact->fname }}</td>
                <td>
                @if ($contact->livesAt)
                        {{ $contact->livesAt->flag }}
                    {{ $contact->livesAt->name_eng_common }}
                    @else
                    ------
                    @endif
                </td>
                <td class="text-center">
                    @if ($contact->gender === 'band')
                    <i class="fas fa-users" aria-hidden="true" aria-label="@ucfirst(__('app.band'))"></i>
                    @elseif ($contact->gender === 'feminine')
                    <i class="fas fa-venus" aria-hidden="true" aria-label="@ucfirst(__('app.feminine'))"></i>
                    @elseif ($contact->gender === 'masculine')
                    <i class="fas fa-mars" aria-hidden="true" aria-label="@ucfirst(__('app.masculine'))"></i>
                    @elseif ($contact->gender === 'neutral')
                    <i class="fas fa-transgender-alt" aria-hidden="true" aria-label="@ucfirst(__('app.neutral'))"></i>
                    @else
                    <i class="fas fa-genderless" aria-hidden="true" aria-label="@ucfirst(__('app.neutral'))"></i>
                    @endif
                </td>
                <td class="text-center">
                    @can('delete')
                    <form method="POST" action="{{ route('admin.contact.delete') }}" class="">
                        @csrf
                        <input type="hidden" name="contact_uuid" value ="{{ $contact->uuid }}" />
                        @endcan
                        <a href="{{ route('admin.contact.show', ['uuid' => $contact->uuid]) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-search"></i>
                        </a>
                        @can('update')
                        <a href="{{ route('admin.contact.edit', ['uuid' => $contact->uuid]) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan
                        @can('delete')
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $contacts->links() }}
@endsection