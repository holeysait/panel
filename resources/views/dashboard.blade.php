@extends('layouts.app')
@section('title','Панель')
@section('content')
<div class="grid md:grid-cols-3 gap-6">
  <div class="bg-white rounded-xl shadow p-6">
    <div class="text-sm text-slate-500">Добро пожаловать</div>
    <div class="text-2xl font-bold mt-1">{{ $user->name }}</div>
  </div>
  <div class="bg-white rounded-xl shadow p-6">
    <div class="text-sm text-slate-500">Ваши серверы</div>
    <div class="text-2xl font-bold mt-1">{{ $serversCount }}</div>
  </div>
  <div class="bg-white rounded-xl shadow p-6">
    <div class="text-sm text-slate-500">Баланс</div>
    <div class="text-2xl font-bold mt-1">
      @if($user->wallet) ${{ number_format($user->wallet->balance_minor/100, 2) }} @else 0.00 @endif
    </div>
  </div>
</div>
@endsection
