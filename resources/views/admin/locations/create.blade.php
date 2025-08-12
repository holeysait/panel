@extends('admin.layouts.app')
@section('admin-title')<h1>{{ __('Locations') }} — {{ __('Create') }}</h1>@endsection
@section('admin-content')
<form method="post" action="{{ route('admin.locations.store') }}" class="form-row">
  @include('admin.locations._form', ['item' => null])
</form>
@endsection
