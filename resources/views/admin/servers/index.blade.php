@extends('admin.layouts.app')
@section('admin-title')<h1>Серверы</h1>@endsection
@section('admin-content')
@php($ok = isset($hasModel) ? $hasModel : false)
@if(!$ok)
<div class="alert">Модель Server не найдена. Установите доменные модели серверов.</div>
@else
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по имени">
  <button class="btn secondary">Искать</button>
</form>
@php($list = isset($items) ? $items : collect())
<table class="admin-table">
  <thead><tr><th>ID</th><th>Имя</th><th>Статус</th><th>Пользователь</th><th></th></tr></thead>
  <tbody>
  @forelse($list as $it)
    <tr>
      <td>{{ $it->id }}</td>
      <td>{{ $it->name ?? '—' }}</td>
      <td><span class="badge">{{ $it->status ?? '—' }}</span></td>
      <td>{{ $it->user_id ?? '—' }}</td>
      <td class="admin-actions"><a class="btn secondary" href="{{ route('admin.servers.show',$it->id) }}">Открыть</a></td>
    </tr>
  @empty
    <tr><td colspan="5">Пока нет серверов</td></tr>
  @endforelse
  </tbody>
</table>
@if(method_exists($list,'links'))
  <div style="margin-top:10px">{{ $list->links() }}</div>
@endif
@endif
@endsection
