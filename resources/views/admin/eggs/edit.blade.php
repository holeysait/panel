@extends('admin.layouts.app')
@section('admin-title')<h1>Редактировать игру/яйцо #{{ $item->id }}</h1>@endsection
@section('admin-content')
<form method="post" action="{{ route('admin.eggs.update', $item) }}">
  @method('PUT')
  @include('admin.eggs._form', ['item'=>$item])
</form>
<form method="post" action="{{ route('admin.eggs.destroy', $item) }}" onsubmit="return confirm('Удалить?');" style="margin-top:10px">
  @csrf @method('DELETE')
  <button class="btn btn-danger" type="submit">Удалить</button>
</form>
@endsection
