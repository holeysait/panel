@extends('layouts.app')
@section('title','Настройки')
@section('content')
  <h1>Настройки</h1>
  <div class="grid-2">
    <div class="card">
      <h2>Профиль</h2>
      <form method="POST" action="{{ route('settings.updateProfile') }}">
        @csrf
        <label>Имя</label>
        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
        <div style="margin-top:10px">
          <button class="btn primary" type="submit">Сохранить</button>
        </div>
      </form>
      <form method="POST" action="{{ route('settings.updateLocale') }}" style="margin-top:14px">
        @csrf
        <label>Язык интерфейса</label>
        <select name="locale">
          <option value="ru" {{ (auth()->user()->locale ?? 'ru')=='ru'?'selected':'' }}>Русский</option>
          <option value="en" {{ (auth()->user()->locale ?? '')=='en'?'selected':'' }}>English</option>
        </select>
        <div style="margin-top:10px">
          <button class="btn" type="submit">Сохранить язык</button>
        </div>
      </form>
    </div>
    <div class="card">
      <h2>Безопасность</h2>
      <form method="POST" action="{{ route('settings.updatePassword') }}">
        @csrf
        <label>Текущий пароль</label>
        <input type="password" name="current_password">
        <label>Новый пароль</label>
        <input type="password" name="password">
        <label>Подтверждение</label>
        <input type="password" name="password_confirmation">
        <div style="margin-top:10px">
          <button class="btn" type="submit">Обновить пароль</button>
        </div>
      </form>
    </div>
  </div>
@endsection
