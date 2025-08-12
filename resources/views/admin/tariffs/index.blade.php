@extends('admin.layouts.app')
@section('admin-title')<h1>Тарифы</h1>@endsection
@section('admin-content')
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по названию/slug">
  <button class="btn secondary">Искать</button>
  <a href="{{ route('admin.tariffs.create') }}" class="btn">Создать</a>
</form>
@php($list = isset($items) ? $items : collect())
<table class="admin-table">
  <thead><tr><th>ID</th><th>Название</th><th>Цена</th><th>Ресурсы</th><th>Активен</th><th></th></tr></thead>
  <tbody>
  @forelse($list as $it)
    <tr>
      <td>{{ $it->id }}</td>
      <td>{{ $it->name }} <div class="text-sm text-gray-500">/{{ $it->slug }}</div></td>
      <td>{{ $it->price_minor }} {{ $it->currency }} / {{ $it->period }}</td>
      <td>CPU {{ $it->cpu_limit }}, RAM {{ $it->ram_mb }} MB, Disk {{ $it->disk_gb }} GB, Ports {{ $it->ports }}</td>
      <td>{!! ($it->is_active ?? false) ? '<span class="badge">да</span>' : 'нет' !!}</td>
      <td class="admin-actions">
        <a class="btn secondary" href="{{ route('admin.tariffs.edit',$it) }}">Редактировать</a>
        <form method="post" action="{{ route('admin.tariffs.destroy',$it) }}" onsubmit="return confirm('Удалить тариф?')">
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
