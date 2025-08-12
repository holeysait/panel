@extends('layouts.app')
@section('title','Регистрация')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow">
  <h1 class="text-xl font-semibold mb-4">Регистрация</h1>
  @if ($errors->any())
    <div class="mb-4 text-red-600">{{ $errors->first() }}</div>
  @endif
  <form method="POST" action="/register" class="space-y-4">
    @csrf
    <div>
      <label class="block text-sm mb-1">Имя</label>
      <input name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm mb-1">Email</label>
      <input name="email" type="email" value="{{ old('email') }}" required class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm mb-1">Пароль</label>
      <input name="password" type="password" required class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm mb-1">Подтверждение пароля</label>
      <input name="password_confirmation" type="password" required class="w-full border rounded px-3 py-2">
    </div>
    <button class="w-full bg-slate-900 text-white py-2 rounded">Зарегистрироваться</button>
  </form>
</div>
@endsection
