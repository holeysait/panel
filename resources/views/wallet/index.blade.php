@extends('layouts.app')
@section('title','Кошелёк')
@section('content')
  <h1>Кошелёк</h1>
  <div class="grid-3" style="margin-bottom:16px;">
    <div class="card"><div class="muted">Баланс</div><div style="font-size:22px;font-weight:700">{{ number_format(($balance ?? 0)/100,2) }} {{ $currency ?? 'USD' }}</div></div>
    <div class="card"><div class="muted">Транзакций</div><div style="font-size:22px;font-weight:700">{{ $txCount ?? 0 }}</div></div>
    <div class="card"><div class="muted">Последняя</div><div style="font-size:16px;font-weight:700">{{ optional($lastTx ?? null)->created_at ?? '—' }}</div></div>
  </div>
  <div class="card">
    <h2>История</h2>
    <table class="table">
      <thead><tr><th>ДАТА</th><th>ТИП</th><th>СУММА</th></tr></thead>
      <tbody>
        @forelse(($transactions ?? []) as $tx)
          <tr>
            <td>{{ $tx->created_at }}</td>
            <td>{{ $tx->type }}</td>
            <td>{{ number_format($tx->amount_minor/100, 2) }}</td>
          </tr>
        @empty
          <tr><td colspan="3" class="muted">Пока нет транзакций</td></tr>
        @endforelse
      </tbody>
    </table>
    @if(method_exists(($transactions ?? null),'links')) {{ $transactions->links() }} @endif
  </div>
@endsection
