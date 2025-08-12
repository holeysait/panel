@extends('admin.layouts.app')
@section('admin-title')<h1>news — список</h1>@endsection
@section('admin-content')
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{ request('q') }" placeholder="Поиск..." />
  <button class="btn secondary">Искать</button>
  <a href="{ route('admin.news.create') }" class="btn">Создать</a>
</form>
<table class="admin-table">
  <thead><tr><th>ID</th><th>Название</th><th>Код/Слаг</th><th></th></tr></thead>
  <tbody>
  @forelse($items as $it)
    <tr>
      <td>{ $it->id }</td>
      <td>{ $it->name ?? $it->title }</td>
      <td>{ $it->code ?? $it->slug }</td>
      <td class="admin-actions">
        <a href="{ route('admin.news.edit', $it) }" class="btn secondary">Редактировать</a>
        <form method="post" action="{ route('admin.news.destroy', $it) }" onsubmit="return confirm('Удалить?')">
          @csrf @method('DELETE')
          <button class="btn secondary" type="submit">Удалить</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="4">Пока пусто</td></tr>
  @endforelse
  </tbody>
</table>
<div style="margin-top:10px">{ $items->links() }</div>
@endsection
