@extends('admin.layouts.app')

@section('admin-title')
<div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
  <h1 style="margin:0;">Узлы — Редактировать #{{ data_get($item, 'id') }}</h1>
  <div style="display:flex; gap:8px; flex-wrap:wrap;">
    <a class="btn" href="{{ route('admin.nodes.onboarding', $item) }}">Страница подключения</a>
    <form method="post" action="{{ route('admin.nodes.ping', $item) }}" style="display:inline">@csrf
      <button class="btn" type="submit">Проверить подключение</button>
    </form>
  </div>
</div>
@endsection

@section('admin-content')
@if ($errors->any())
  <div class="alert alert-danger">
    <ul style="margin:0; padding-left:18px;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
@if(session('ok'))<div class="alert alert-success">{{ session('ok') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

<form method="post" action="{{ route('admin.nodes.update', $item) }}">
  @csrf
  @method('PUT')

  <div style="display:grid; grid-template-columns: repeat(2, minmax(0, 420px)); gap:14px;">
    <label>Название
      <input type="text" name="name" value="{{ old('name', $item->name) }}" required>
    </label>

    <label>Public FQDN
      <input type="text" name="public_fqdn" value="{{ old('public_fqdn', $item->public_fqdn) }}">
    </label>

    <label>Agent/Daemon URL
      <input type="text" name="daemon_url" value="{{ old('daemon_url', $item->daemon_url) }}" placeholder="http://IP:8088">
    </label>

    <label>Локация
      <select name="location_id" required>
        @foreach($locations as $loc)
          <option value="{{ $loc->id }}" @selected(old('location_id',$item->location_id)==$loc->id)>{{ $loc->name }}</option>
        @endforeach
      </select>
    </label>

    <label>Статус
      <input type="text" name="status" value="{{ old('status', $item->status) }}">
    </label>

    <label>Capabilities (JSON)
      <textarea name="capabilities" rows="6">{{ old('capabilities', is_array($item->capabilities) ? json_encode($item->capabilities, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) : ($item->capabilities ?? '')) }}</textarea>
      <small>Пример: {"cpu":"Ryzen 9","ram_gb":128,"ports":[10000,19999]}</small>
    </label>
  </div>

  <div style="display:flex; gap:8px; margin-top:14px;">
    <button class="btn btn-primary" type="submit">Save</button>
    <a class="btn" href="{{ route('admin.nodes.index') }}">Cancel</a>
  </div>
</form>

<form method="post" action="{{ route('admin.nodes.destroy', $item) }}" onsubmit="return confirm('Удалить узел?');" style="margin-top:14px">
  @csrf @method('DELETE')
  <button class="btn btn-danger" type="submit">Delete</button>
</form>
@endsection
