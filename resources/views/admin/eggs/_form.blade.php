@csrf
<div class="grid" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px">
  <label>Название
    <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required>
  </label>
  <label>Docker image
    <input type="text" name="docker_image" value="{{ old('docker_image', $item->docker_image ?? '') }}" required placeholder="ghcr.io/vendor/img:tag">
  </label>
  <label>Startup command
    <input type="text" name="startup_cmd" value="{{ old('startup_cmd', $item->startup_cmd ?? '') }}" required placeholder="bash start.sh {{ARGS}}">
  </label>
  <label>Version
    <input type="text" name="version" value="{{ old('version', $item->version ?? '') }}">
  </label>
  <label>Author
    <input type="text" name="author" value="{{ old('author', $item->author ?? '') }}">
  </label>
  <label>Source URL
    <input type="url" name="source_url" value="{{ old('source_url', $item->source_url ?? '') }}">
  </label>

  <label style="grid-column: 1 / -1">Features (JSON)
    <textarea name="features" rows="6">{{ old('features', isset($item) && is_array($item->features) ? json_encode($item->features, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) : '') }}</textarea>
    <small>Пример: {"rcon":true,"allocations":["tcp","udp"]}</small>
  </label>
</div>
<div class="form-actions" style="margin-top:14px">
  <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
  <a class="btn" href="{{ route('admin.eggs.index') }}">{{ __('Cancel') }}</a>
</div>
