@extends('layouts.app')
@section('title','Кошелёк')
@section('content')
<h1 class="text-xl font-semibold mb-4">Кошелёк</h1>
<div class="bg-white rounded-xl shadow p-6">
  <div class="text-slate-500 text-sm">Баланс</div>
  <div class="text-3xl font-bold">${{ number_format(($wallet->balance_minor ?? 0)/100, 2) }}</div>
</div>

<h2 class="mt-6 mb-2 font-semibold">Транзакции</h2>
<div class="bg-white rounded-xl shadow overflow-hidden">
  <table class="min-w-full">
    <thead class="bg-slate-100 text-left text-sm">
      <tr><th class="p-3">Дата</th><th class="p-3">Тип</th><th class="p-3">Сумма</th><th class="p-3">Meta</th></tr>
    </thead>
    <tbody class="divide-y">
    @forelse ($transactions as $tx)
      <tr>
        <td class="p-3">{{ $tx->created_at }}</td>
        <td class="p-3">{{ $tx->type }}</td>
        <td class="p-3">{{ $tx->amount_minor/100 }}</td>
        <td class="p-3 text-sm text-slate-500">{{ json_encode($tx->meta) }}</td>
      </tr>
    @empty
      <tr><td class="p-3 text-slate-500" colspan="4">Нет транзакций.</td></tr>
    @endforelse
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $transactions->links() }}</div>
@endsection
