@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render() !!}
@endsection

@section('content')
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link active" href="{{ route('admin.home') }}">Dashboard</a></li>
    </ul>

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">Edit</a>

        @if ($user->isWait())
        {{--TODO сделать user.verify--}}
            <form method="POST" action="{{ route('admin.users.verify', $user) }}" class="mr-1">
            {{--<form method="POST" action="{{ route('register.verify', $user) }}" class="mr-1">--}}
                @csrf
                <button class="btn btn-success">Verify</button>
            </form>
        @endif

        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th><td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>

                {{--@if ($user->isWait())--}}
                    {{--<span class="badge badge-secondary">Waiting</span>--}}
                {{--@endif--}}
                {{--@if ($user->isActive())--}}
                    {{--<span class="badge badge-primary">Active</span>--}}
                {{--@endif--}}
            </td>
        </tr>
        <tr>
            <th>Role</th>
            <td>

                {{--@if ($user->isAdmin())--}}
                    {{--<span class="badge badge-danger">Admin</span>--}}
                {{--@else--}}
                    {{--<span class="badge badge-secondary">User</span>--}}
                {{--@endif--}}
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>

@endsection