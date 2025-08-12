@extends('admin.layouts.app')
@section('admin-title')<h1>Игра/Яйцо — {{ $item->name }}</h1>@endsection
@section('admin-content')
<div class="card"><div class="card-body">
  <dl class="grid" style="display:grid;grid-template-columns:200px 1fr;gap:8px">
    <dt>ID</dt><dd>{{ $item->id }}</dd>
    <dt>Docker image</dt><dd>{{ $item->docker_image }}</dd>
    <dt>Startup</dt><dd><code>{{ $item->startup_cmd }}</code></dd>
    <dt>Версия</dt><dd>{{ $item->version }}</dd>
    <dt>Автор</dt><dd>{{ $item->author }}</dd>
    <dt>Source URL</dt><dd><a href="{{ $item->source_url }}" target="_blank">{{ $item->source_url }}</a></dd>
    <dt>Features</dt><dd><pre>{{ json_encode($item->features, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre></dd>
  </dl>
  <div class="form-actions" style="margin-top:12px">
    <a class="btn btn-primary" href="{{ route('admin.eggs.edit', $item) }}">Редактировать</a>
    <a class="btn" href="{{ route('admin.eggs.index') }}">Назад</a>
  </div>
</div></div>

@if(($item->variables ?? null) && $item->variables->count())
<hr>
<h3>Переменные (env) — {{ $item->variables->count() }}</h3>
<table class="table">
  <thead><tr><th>ENV ключ</th><th>Метка</th><th>Описание</th><th>По умолчанию</th></tr></thead>
  <tbody>
    @foreach($item->variables as $v)
    <tr>
      <td><code>{{ $v->env_key }}</code></td>
      <td>{{ $v->label }}</td>
      <td>{{ $v->description }}</td>
      <td><code>{{ $v->default }}</code></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
@endsection
