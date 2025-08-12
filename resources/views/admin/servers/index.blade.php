@extends('admin.layouts.app')
@section('admin-title')<h1>Серверы</h1>@endsection
@section('admin-content')
<form method="get" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по имени/UUID">
  <button class="btn" type="submit">Поиск</button>
</form>
<table class="table">
  <thead><tr><th>ID</th><th>UUID</th><th>Название</th><th>Пользователь</th><th>Узел</th><th>Статус</th><th></th></tr></thead>
  <tbody>
  @foreach($items as $it)
  <tr>
    <td>{{ $it->id }}</td>
    <td>{{ $it->uuid }}</td>
    <td>{{ $it->name }}</td>
    <td>{{ optional($it->user)->email ?? '-' }}</td>
    <td>{{ optional($it->node)->name ?? '-' }}</td>
    <td>{{ $it->status }}</td>
    <td><a class="btn btn-sm" href="{{ route('admin.servers.show', $it) }}">Открыть</a></td>
  </tr>
  @endforeach
  </tbody>
</table>
{{ $items->links() }}
@endsection
