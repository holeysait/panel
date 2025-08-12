@extends('layouts.app')
@section('title','Серверы')
@section('content')
<h1 class="text-xl font-semibold mb-4">Мои серверы</h1>
<div class="bg-white rounded-xl shadow divide-y">
  @forelse ($servers as $srv)
    <div class="p-4 flex items-center justify-between">
      <div>
        <div class="font-medium">{{ $srv->name }}</div>
        <div class="text-sm text-slate-500">UUID: {{ $srv->uuid }} • {{ $srv->status }} • {{ optional($srv->egg)->name }}</div>
      </div>
      <div class="text-sm text-slate-500">CPU {{ $srv->cpu_limit }} • RAM {{ $srv->ram_mb }}MB • Disk {{ $srv->disk_gb }}GB</div>
    </div>
  @empty
    <div class="p-6 text-slate-500">У вас пока нет серверов.</div>
  @endforelse
</div>
<div class="mt-4">{{ $servers->links() }}</div>
@endsection
