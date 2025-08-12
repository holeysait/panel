@extends('admin.layouts.app')
@section('admin-content')
<h1>Админка — главная</h1>
<div class="grid-3">
    <div class="card"><div class="muted">Пользователей</div><div class="stat">{{ $stats['users'] ?? 0 }}</div></div>
    <div class="card"><div class="muted">Серверов</div><div class="stat">{{ $stats['servers'] ?? 0 }}</div></div>
    <div class="card"><div class="muted">Транзакций</div><div class="stat">{{ $stats['transactions'] ?? 0 }}</div></div>
</div>
<div class="card mt-3">
    <div class="muted">Тарифов</div>
    <div class="stat">{{ $stats['prices'] ?? 0 }}</div>
</div>
@endsection