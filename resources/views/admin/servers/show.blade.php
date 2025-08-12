@extends('admin.layouts.app')
@section('admin-title')<h1>Сервер #{{ $item->id }}</h1>@endsection
@section('admin-content')
<form method="post" action="{{ route('admin.servers.update',$item->id) }}" class="form-row">
@csrf @method('PATCH')
<label class="full">Имя <input type="text" name="name" value="{{ old('name',$item->name) }}"/></label>
<label class="full">Статус <input type="text" name="status" value="{{ old('status',$item->status) }}"/></label>
<div class="form-actions full">
  <a href="{{ route('admin.servers.index') }}" class="btn secondary">Назад</a>
  <button class="btn">Сохранить</button>
</div>
</form>
@endsection
