@extends('layouts.app')

@section('title', 'Дашборд')

@section('content')
<div class="cards grid-3">
  <div class="card stat">
    <div class="stat-title">Ваши серверы</div>
    <div class="stat-value">{{ $serverCount ?? 0 }}</div>
  </div>
  <div class="card stat">
    <div class="stat-title">Баланс</div>
    <div class="stat-value">{{ number_format(($balance ?? 0)/100, 2, '.', ' ') }} {{ $currency ?? 'USD' }}</div>
  </div>
  <div class="card stat">
    <div class="stat-title">Состояние</div>
    <div class="stat-value">{{ ($serverCount ?? 0) > 0 ? 'Активно' : 'Нет серверов' }}</div>
  </div>
</div>

<div class="grid-2 mt-4">
  <div class="card">
    <div class="card-header">Последние транзакции</div>
    <div class="card-body">
      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Тип</th>
              <th>Сумма (minor)</th>
              <th>Когда</th>
            </tr>
          </thead>
          <tbody>
            @forelse($transactions as $tx)
              <tr>
                <td>{{ $tx->id }}</td>
                <td>{{ $tx->type }}</td>
                <td>{{ $tx->amount_minor }}</td>
                <td>{{ $tx->created_at }}</td>
              </tr>
            @empty
              <tr><td colspan="4" class="text-muted">История пуста.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Текущие цены</div>
    <div class="card-body">
      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>Код</th>
              <th>Единица</th>
              <th>Цена (minor)</th>
            </tr>
          </thead>
          <tbody>
            @forelse($prices as $p)
              <tr>
                <td>{{ $p->code }}</td>
                <td>{{ $p->unit }}</td>
                <td>{{ $p->unit_price_minor }}</td>
              </tr>
            @empty
              <tr><td colspan="3" class="text-muted">Записей нет.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
