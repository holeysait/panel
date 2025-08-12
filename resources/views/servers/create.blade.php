@extends('layouts.app')
@section('content')
<h1>Создать сервер</h1>
<form method="post" action="{{ route('servers.store') }}">
  @csrf
  <div class="row">
    <label>Название
      <input type="text" name="name" value="{{ old('name') }}" required>
    </label>
  </div>
  <div class="row">
    <label>Локация
      <select name="location_slug" id="location" required>
        <option value="">-- выберите --</option>
        @foreach($locations as $loc)
          <option value="{{ $loc->slug }}" @selected(old('location_slug')===$loc->slug)>{{ $loc->name }}</option>
        @endforeach
      </select>
    </label>
  </div>
  <div class="row">
    <label>Узел
      <select name="node_id" id="node" required>
        <option value="">-- выберите локацию --</option>
      </select>
    </label>
  
  <div class="row">
    <label>Игра / Яйцо (egg)
      <select name="egg_id" required>
        <option value="">-- выберите игру/яйцо --</option>
        @forelse($eggs as $egg)
          <option value="{{ $egg->id }}" @selected(old('egg_id')==$egg->id)>{{ $egg->name }}</option>
        @empty
          <option value="">(нет доступных яиц — обратитесь к администратору)</option>
        @endforelse
      </select>
    </label>
    @error('egg_id')<div class="text-danger">{{ $message }}</div>@enderror
  </div>

  <div class="row">
    <label>CPU limit
      <input type="number" name="cpu_limit" value="{{ old('cpu_limit', 200) }}" min="1">
    </label>
  </div>
  <div class="row">
    <label>RAM (MB)
      <input type="number" name="ram_mb" value="{{ old('ram_mb', 4096) }}" min="256">
    </label>
  </div>
  <div class="row">
    <label>Disk (GB)
      <input type="number" name="disk_gb" value="{{ old('disk_gb', 30) }}" min="1">
    </label>
  </div>
  <div class="form-actions" style="margin-top:12px">
    <button class="btn btn-primary" type="submit">Создать</button>
    <a class="btn" href="{{ route('servers.index') }}">Отмена</a>
  </div>
</form>

<script>
async function loadNodes(slug) {
  const nodeSel = document.getElementById('node');
  nodeSel.innerHTML = '<option value="">загрузка...</option>';
  try {
    const res = await fetch('/api/locations/' + slug + '/nodes');
    const js = await res.json();
    nodeSel.innerHTML = '<option value="">-- выберите узел --</option>';
    js.nodes.forEach(n => {
      const opt = document.createElement('option');
      opt.value = n.id;
      opt.textContent = n.name + ' (' + n.public_fqdn + ')';
      nodeSel.appendChild(opt);
    });
  } catch(e) {
    nodeSel.innerHTML = '<option value="">ошибка загрузки узлов</option>';
  }
}
document.getElementById('location').addEventListener('change', (e)=>{
  if (e.target.value) loadNodes(e.target.value);
});
@if(old('location_slug'))
  loadNodes(@json(old('location_slug')));
@endif
</script>
@endsection
