@extends('admin.layouts.app')
@section('admin-title')<h1>Локации</h1>@endsection
@section('admin-content')
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по названию/slug/городу/стране">
  <button class="btn secondary">Искать</button>
  <a href="{{ route('admin.locations.create') }}" class="btn">Создать</a>
</form>
@php($list = isset($items) ? $items : collect())
<table class="admin-table">
  <thead><tr><th>ID</th><th>Название</th><th>Гео</th><th>Активна</th><th></th></tr></thead>
  <tbody>
  @forelse($list as $it)
    <tr>
      <td>{{ $it->id }}</td>
      <td>{{ $it->name }} <div class="text-sm text-gray-500">/{{ $it->slug }}</div></td>
      <td>{{ $it->country ?? '—' }} {{ $it->city ? ' / '.$it->city : '' }}</td>
      <td>{!! ($it->is_active ?? false) ? '<span class="badge">да</span>' : 'нет' !!}</td>
      <td class="admin-actions">
        <a class="btn secondary" href="{{ route('admin.locations.edit',$it) }}">Редактировать</a>
        <form method="post" action="{{ route('admin.locations.destroy',$it) }}" onsubmit="return confirm('Удалить локацию?')">
          @csrf @method('DELETE')
          <button class="btn secondary" type="submit">Удалить</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="5">Пока пусто</td></tr>
  @endforelse
  </tbody>
</table>
@if(method_exists($list,'links'))
  <div style="margin-top:10px">{{ $list->links() }}</div>
@endif
@endsection
