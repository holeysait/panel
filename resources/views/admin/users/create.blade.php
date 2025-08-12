@extends('admin.layouts.app')
@section('admin-title')<h1>Создать пользователя</h1>@endsection
@section('admin-content')
<form method="post" action="{{ route('admin.users.store') }}" class="form-row">
@csrf
<label class="full">Имя <input type="text" name="name" value="{{ old('name') }}"/></label>
<label class="full">Email <input type="email" name="email" value="{{ old('email') }}"/></label>
<label>Пароль <input type="password" name="password"/></label>
<label>Подтверждение <input type="password" name="password_confirmation"/></label>
<label class="full"><input type="checkbox" name="is_admin" value="1"/> Администратор</label>
<div class="form-actions full">
  <a href="{{ route('admin.users.index') }}" class="btn secondary">Отмена</a>
  <button class="btn">Сохранить</button>
</div>
</form>
@endsection
