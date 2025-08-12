@extends('layouts.app')

@section('head')
    @includeIf('admin.partials.head')
@endsection

@section('content')
    @include('admin.partials.nav')
    <div class="admin-wrap">
        @yield('admin')
    </div>
@endsection
