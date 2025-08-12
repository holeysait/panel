@extends('admin.layouts.app')
@section('admin-title')<h1>Игры / Яйца</h1>@endsection
@section('admin-content')
@if(session('ok'))<div class="alert alert-success">{{ session('ok') }}</div>@endif
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск">
  <button class="btn" type="submit">Поиск</button>
  <a class="btn btn-primary" href="{{ route('admin.eggs.create') }}">Создать</a>
</form>
<table class="table">
  <thead><tr><th>ID</th><th>Название</th><th>Docker image</th><th>Версия</th><th></th></tr></thead>
  <tbody>
  @foreach($items as $it)
    <tr>
      <td>{{ $it->id }}</td>
      <td><a href="{{ route('admin.eggs.show', $it) }}">{{ $it->name }}</a></td>
      <td>{{ $it->docker_image }}</td>
      <td>{{ $it->version }}</td>
      <td><a class="btn btn-sm" href="{{ route('admin.eggs.edit', $it) }}">Редактировать</a></td>
    </tr>
  @endforeach
  </tbody>
</table>
{{ $items->withQueryString()->links() }}
@endsection
