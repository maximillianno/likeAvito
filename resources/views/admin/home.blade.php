@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render() !!}
@endsection

@section('content')
    @include('admin._nav', ['page' => ''])
@endsection