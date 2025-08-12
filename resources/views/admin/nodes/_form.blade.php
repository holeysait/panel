@csrf
<div class="grid" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px">
  <label>Название
    <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required>
  </label>
  <label>Public FQDN
    <input type="text" name="public_fqdn" value="{{ old('public_fqdn', $item->public_fqdn ?? '') }}" required>
  </label>
  <label>Agent/Daemon URL
    <input type="url" name="daemon_url" value="{{ old('daemon_url', $item->daemon_url ?? '') }}" required>
  </label>
  <label>Локация
    <select name="location_id">
      <option value="">{{ __('(not set)') }}</option>
      @foreach($locations as $id=>$name)
        <option value="{{ $id }}" @selected(old('location_id', $item->location_id ?? '') == $id)>{{ $name }}</option>
      @endforeach
    </select>
  </label>
  <label>Статус
    <input type="text" name="status" value="{{ old('status', $item->status ?? 'offline') }}">
  </label>
  <label>Capabilities (JSON)
    <textarea name="capabilities" rows="4">{{ old('capabilities', isset($item)?json_encode($item->capabilities, JSON_UNESCAPED_UNICODE):'{}') }}</textarea>
    <small>Пример: {"cpu":"Ryzen 9","ram_gb":128,"ports":[10000,19999]}</small>
  </label>
</div>
<div class="form-actions" style="margin-top:14px">
  <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
  <a class="btn" href="{{ route('admin.nodes.index') }}">{{ __('Cancel') }}</a>
</div>
