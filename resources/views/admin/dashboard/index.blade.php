@extends('admin.layouts.app')
@section('admin-title')<h1>Админка — Dashboard</h1>@endsection
@section('admin-content')
<div class="form-row full" style="grid-template-columns: repeat(3,1fr)">
  <div class="card"><div class="p-3">Пользователи<br><strong>{{ $users ?? 0 }}</strong></div></div>
  <div class="card"><div class="p-3">Серверы<br><strong>{{ $servers ?? 0 }}</strong></div></div>
  <div class="card"><div class="p-3">Транзакции<br><strong>{{ $tx ?? 0 }}</strong></div></div>
</div>

<h3>Последние транзакции</h3>
<table class="admin-table">
  <thead><tr><th>ID</th><th>Wallet ID</th><th>Type</th><th>Amount (minor)</th><th>When</th></tr></thead>
  <tbody>
  @php($data = isset($last) ? $last : collect())
  @forelse($data as $it)
    <tr><td>{{ $it->id }}</td><td>{{ $it->wallet_id }}</td><td>{{ $it->type }}</td><td>{{ $it->amount_minor }}</td><td>{{ $it->created_at }}</td></tr>
  @empty
    <tr><td colspan="5">Транзакций пока нет.</td></tr>
  @endforelse
  </tbody>
</table>
@endsection
