@extends('layouts.app')
@section('layout_class','centered')
@section('content')
  <div class="auth-card card pad">
    <h1 class="auth-title">BSPANel</h1>
    <p class="text-muted">Пожалуйста, <a href="{{ route('login') }}">войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>.</p>
  </div>
@endsection
