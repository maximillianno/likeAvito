@extends('layouts.app')

@section('content')
    @include('admin.regions._nav')

    {{--<ul class="nav nav-tabs mb-3">--}}
        {{--<li class="nav-item"><a class="nav-link" href="{{ route('admin.home') }}">Dashboard</a></li>--}}
        {{--<li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>--}}
        {{--<li class="nav-item"><a class="nav-link active" href="{{ route('admin.regions.index') }}">Regions</a></li>--}}

    {{--</ul>--}}
    <p><a href="{{ route('admin.regions.create') }}" class="btn btn-success">Add Region</a></p>

    @include('admin.regions._list', ['regions' => $regions])
@endsection