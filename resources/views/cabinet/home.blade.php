@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render() !!}
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                Your cabinet!
            </div>
        </div>
    </div>
</div>

@endsection
