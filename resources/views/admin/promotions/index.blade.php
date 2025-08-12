@extends('admin.layouts.app')
@section('admin-title')<h1>Акции</h1>@endsection
@section('admin-content')
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по названию/коду">
  <button class="btn secondary">Искать</button>
  <a href="{{ route('admin.promotions.create') }}" class="btn">Создать</a>
</form>
@php($list = isset($items) ? $items : collect())
<table class="admin-table">
  <thead><tr><th>ID</th><th>Название</th><th>Код</th><th>Тип/Значение</th><th>Период</th><th>Активна</th><th></th></tr></thead>
  <tbody>
  @forelse($list as $it)
    <tr>
      <td>{{ $it->id }}</td>
      <td>{{ $it->name }}</td>
      <td>{{ $it->code }}</td>
      <td>{{ $it->type }} {{ $it->value }}</td>
      <td>{{ $it->starts_at ?? '—' }} — {{ $it->ends_at ?? '—' }}</td>
      <td>{!! ($it->is_active ?? false) ? '<span class="badge">да</span>' : 'нет' !!}</td>
      <td class="admin-actions">
        <a class="btn secondary" href="{{ route('admin.promotions.edit',$it) }}">Редактировать</a>
        <form method="post" action="{{ route('admin.promotions.destroy',$it) }}" onsubmit="return confirm('Удалить акцию?')">
          @csrf @method('DELETE')
          <button class="btn secondary" type="submit">Удалить</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="7">Пока пусто</td></tr>
  @endforelse
  </tbody>
</table>
@if(method_exists($list,'links'))
  <div style="margin-top:10px">{{ $list->links() }}</div>
@endif
@endsection
