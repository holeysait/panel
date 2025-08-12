@extends('admin.layouts.app')

@section('admin-title')
<div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
  <h1 style="margin:0;">Узлы — Просмотр #{{ data_get($item, 'id') }}</h1>
  <div style="display:flex; gap:8px; flex-wrap:wrap;">
    <a class="btn" href="{{ route('admin.nodes.edit', $item) }}">Редактировать</a>
    <a class="btn" href="{{ route('admin.nodes.onboarding', $item) }}">Страница подключения</a>
    <form method="post" action="{{ route('admin.nodes.ping', $item) }}" style="display:inline">@csrf
      <button class="btn" type="submit">Проверить подключение</button>
    </form>
  </div>
</div>
@endsection

@section('admin-content')
@if(session('ok'))<div class="alert alert-success">{{ session('ok') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

<div class="card"><div class="card-body">
  <dl style="display:grid; grid-template-columns: 220px 1fr; gap:8px;">
    <dt>ID</dt><dd>{{ $item->id }}</dd>
    <dt>Название</dt><dd>{{ $item->name }}</dd>
    <dt>Public FQDN</dt><dd>{{ $item->public_fqdn }}</dd>
    <dt>Agent/Daemon URL</dt><dd>{{ $item->daemon_url }}</dd>
    <dt>Локация</dt><dd>{{ optional($item->location)->name ?? '-' }}</dd>
    <dt>Статус</dt><dd>{{ $item->status }}</dd>
    <dt>last_seen_at</dt><dd>{{ $item->last_seen_at }}</dd>
    <dt>Последняя ошибка</dt><dd>{{ $item->last_health_error }}</dd>
    <dt>Capabilities</dt><dd><pre style="margin:0">{{ is_array($item->capabilities) ? json_encode($item->capabilities, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) : ($item->capabilities ?? '') }}</pre></dd>
  </dl>
</div></div>
@endsection
