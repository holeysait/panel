@extends('admin.layouts.app')
@section('admin-title')<h1>Создать игру/яйцо</h1>@endsection
@section('admin-content')
<form method="post" action="{{ route('admin.eggs.store') }}">
  @include('admin.eggs._form', ['item'=>null])
</form>
@endsection
