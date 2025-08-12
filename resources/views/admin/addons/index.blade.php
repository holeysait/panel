@extends('admin.layouts.app')
@section('admin-title')<h1>Дополнения</h1>@endsection
@section('admin-content')
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по имени/коду">
  <button class="btn secondary">Искать</button>
  <a href="{{ route('admin.addons.create') }}" class="btn">Создать</a>
</form>
@php($list = isset($items) ? $items : collect())
<table class="admin-table">
  <thead><tr><th>ID</th><th>Название</th><th>Код</th><th>Цена</th><th>Активен</th><th></th></tr></thead>
  <tbody>
  @forelse($list as $it)
    <tr>
      <td>{{ $it->id }}</td>
      <td>{{ $it->name }}</td>
      <td>{{ $it->code }}</td>
      <td>{{ $it->unit_price_minor }} {{ $it->currency }}</td>
      <td>{!! ($it->is_active ?? false) ? '<span class="badge">да</span>' : 'нет' !!}</td>
      <td class="admin-actions">
        <a class="btn secondary" href="{{ route('admin.addons.edit',$it) }}">Редактировать</a>
        <form method="post" action="{{ route('admin.addons.destroy',$it) }}" onsubmit="return confirm('Удалить дополнение?')">
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
