@extends('admin.layouts.app')
@section('admin-title')<h1>Редактировать пользователя #{{ $user->id }}</h1>@endsection
@section('admin-content')
<form method="post" action="{{ route('admin.users.update',$user) }}" class="form-row">
@csrf @method('PUT')
<label class="full">Имя <input type="text" name="name" value="{{ old('name',$user->name) }}"/></label>
<label class="full">Email <input type="email" name="email" value="{{ old('email',$user->email) }}"/></label>
<label>Новый пароль <input type="password" name="password"/></label>
<label>Подтверждение <input type="password" name="password_confirmation"/></label>
<label class="full"><input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked':'' }}/> Администратор</label>
<div class="form-actions full">
  <a href="{{ route('admin.users.index') }}" class="btn secondary">Назад</a>
  <button class="btn">Обновить</button>
</div>
</form>
@endsection
