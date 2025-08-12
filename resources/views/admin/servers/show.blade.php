@extends('admin.layouts.app')
@section('admin-title')<h1>Сервер #{{ $item->id }}</h1>@endsection
@section('admin-content')
<div class="card"><div class="card-body">
  <dl>
    <dt>UUID</dt><dd>{{ $item->uuid }}</dd>
    <dt>Название</dt><dd>{{ $item->name }}</dd>
    <dt>Пользователь</dt><dd>{{ optional($item->user)->email ?? '-' }}</dd>
    <dt>Узел</dt><dd>{{ optional($item->node)->name ?? '-' }}</dd>
    <dt>Статус</dt><dd>{{ $item->status }}</dd>
    <dt>CPU</dt><dd>{{ $item->cpu_limit }}</dd>
    <dt>RAM</dt><dd>{{ $item->ram_mb }} MB</dd>
    <dt>Disk</dt><dd>{{ $item->disk_gb }} GB</dd>
  </dl>
  <a class="btn" href="{{ route('admin.servers.index') }}">Назад</a>
</div></div>
@endsection
