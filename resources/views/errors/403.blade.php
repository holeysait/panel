@extends('layouts.app')
@section('title','Доступ запрещён')
@section('content')
<div class="card" style="max-width: 720px; margin: 40px auto;">
  <h1>403 — Доступ запрещён</h1>
  <p>Требуются права администратора. Если это ошибка — обратитесь к владельцу панели.</p>
  <a href="{{ route('dashboard') }}" class="btn">На главную</a>
</div>
@endsection
