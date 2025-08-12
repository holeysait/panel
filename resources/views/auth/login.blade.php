@extends('layouts.app')
@section('title','Вход')
@section('content')
  <h1>Вход</h1>
  <div class="card auth-card">
    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
      <label for="password">Пароль</label>
      <input id="password" type="password" name="password" required>
      <div class="checkbox">
        <input id="remember" type="checkbox" name="remember">
        <label for="remember" style="margin:0;font-weight:500">Запомнить меня</label>
      </div>
      <button class="btn primary block" type="submit">Войти</button>
    </form>
    <p class="muted" style="margin-top:10px;">Нет аккаунта? <a href="{{ route('register') }}">Регистрация</a></p>
  </div>
@endsection
