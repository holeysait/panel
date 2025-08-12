@extends('admin.layouts.app')
@section('admin-title')<h1>Пользователи</h1>@endsection
@section('admin-content')
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ $q }}" placeholder="Поиск по имени/email"/>
  <button class="btn secondary">Искать</button>
  <a href="{{ route('admin.users.create') }}" class="btn">Создать</a>
</form>
<table class="admin-table">
  <thead><tr><th>ID</th><th>Имя</th><th>Email</th><th>Админ</th><th></th></tr></thead>
  <tbody>
  @forelse($users as $u)
    <tr>
      <td>{{ $u->id }}</td>
      <td>{{ $u->name }}</td>
      <td>{{ $u->email }}</td>
      <td>{!! $u->is_admin ? '<span class="badge">да</span>' : 'нет' !!}</td>
      <td class="admin-actions">
        <a class="btn secondary" href="{{ route('admin.users.edit',$u) }}">Редактировать</a>
        <form method="post" action="{{ route('admin.users.destroy',$u) }}" onsubmit="return confirm('Удалить пользователя?')">
          @csrf @method('DELETE')
          <button class="btn secondary" type="submit">Удалить</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="5">Пока нет пользователей</td></tr>
  @endforelse
  </tbody>
</table>
<div style="margin-top:10px">{{ $users->links() }}</div>
@endsection
