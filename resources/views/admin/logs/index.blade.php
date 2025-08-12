@extends('admin.layouts.app')
@section('admin-title')<h1>Логи (аудит)</h1>@endsection
@section('admin-content')
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по действию"/>
  <button class="btn secondary">Искать</button>
</form>
<table class="admin-table">
  <thead><tr><th>ID</th><th>User</th><th>Action</th><th>Model</th><th>At</th></tr></thead>
  <tbody>
  @forelse($items as $it)
    <tr>
      <td>{{ $it->id }}</td><td>{{ $it->user_id }}</td><td>{{ $it->action }}</td>
      <td>{{ $it->model }}#{{ $it->model_id }}</td><td>{{ $it->created_at }}</td>
    </tr>
  @empty
    <tr><td colspan="5">Пока пусто</td></tr>
  @endforelse
  </tbody>
</table>
<div style="margin-top:10px">{{ $items->links() }}</div>
@endsection
