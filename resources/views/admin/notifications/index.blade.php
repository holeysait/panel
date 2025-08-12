@extends('admin.layouts.app')
@section('admin-title')<h1>Уведомления / Рассылки</h1>@endsection
@section('admin-content')
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по названию">
  <button class="btn secondary">Искать</button>
  <a href="{{ route('admin.notifications.create') }}" class="btn">Создать</a>
</form>
@php($list = isset($items) ? $items : collect())
<table class="admin-table">
  <thead><tr><th>ID</th><th>Название</th><th>Канал</th><th>Статус</th><th>План</th><th></th></tr></thead>
  <tbody>
  @forelse($list as $it)
    <tr>
      <td>{{ $it->id }}</td>
      <td>{{ $it->name }}</td>
      <td>{{ $it->channel }}</td>
      <td><span class="badge">{{ $it->status }}</span></td>
      <td>{{ $it->scheduled_at ?? '—' }}</td>
      <td class="admin-actions">
        <a class="btn secondary" href="{{ route('admin.notifications.edit',$it) }}">Редактировать</a>
        <form method="post" action="{{ route('admin.notifications.destroy',$it) }}" onsubmit="return confirm('Удалить кампанию?')">
          @csrf @method('DELETE')
          <button class="btn secondary" type="submit">Удалить</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="6">Пока пусто</td></tr>
  @endforelse
  </tbody>
</table>
@if(method_exists($list,'links'))
  <div style="margin-top:10px">{{ $list->links() }}</div>
@endif
@endsection
