@extends('admin.layouts.app')
@section('admin-title')<h1>{{ __('Locations') }} — {{ __('Edit') }} #{{ $item->id }}</h1>@endsection
@section('admin-content')
<form method="post" action="{{ route('admin.locations.update', $item) }}" class="form-row">
  @method('PUT')
  @include('admin.locations._form', ['item' => $item])
</form>
<form method="post" action="{{ route('admin.locations.destroy', $item) }}" onsubmit="return confirm('Удалить локацию?');" style="margin-top:10px">
  @csrf @method('DELETE')
  <button class="btn btn-danger" type="submit">{{ __('Delete') }}</button>
</form>
@endsection
