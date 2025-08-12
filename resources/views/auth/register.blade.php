@extends('layouts.app')
@section('title','Регистрация')
@section('content')
  <h1>Регистрация</h1>
  <div class="card auth-card">
    <form method="POST" action="{{ route('register.post') }}">
      @csrf
      <label for="name">Имя</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" required>
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required>
      <label for="password">Пароль</label>
      <input id="password" type="password" name="password" required>
      <label for="password_confirmation">Подтверждение пароля</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required>
      <button class="btn primary block" type="submit">Создать аккаунт</button>
    </form>
    <p class="muted" style="margin-top:10px;">Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
  </div>
@endsection
