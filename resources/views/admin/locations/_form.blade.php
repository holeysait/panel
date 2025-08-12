@csrf
<div class="grid" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px">
  <label>Название
    <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required>
  </label>
  <label>Slug
    <input type="text" name="slug" value="{{ old('slug', $item->slug ?? '') }}" required>
  </label>
  <label>Страна (ISO2)
    <input type="text" name="country" value="{{ old('country', $item->country ?? '') }}" maxlength="2">
  </label>
  <label>Город
    <input type="text" name="city" value="{{ old('city', $item->city ?? '') }}">
  </label>
  <label>Провайдер/ДЦ
    <input type="text" name="meta[provider]" value="{{ old('meta.provider', data_get($item->meta ?? [], 'provider')) }}">
  </label>
  <label>Часовой пояс
    <input type="text" name="meta[timezone]" value="{{ old('meta.timezone', data_get($item->meta ?? [], 'timezone', 'Europe/Warsaw')) }}">
  </label>
  <label>Пул портов (от)
    <input type="number" name="meta[ports_from]" value="{{ old('meta.ports_from', data_get($item->meta ?? [], 'ports_from', 10000)) }}">
  </label>
  <label>Пул портов (до)
    <input type="number" name="meta[ports_to]" value="{{ old('meta.ports_to', data_get($item->meta ?? [], 'ports_to', 19999)) }}">
  </label>
  <label>Test IP
    <input type="text" name="meta[test_ip]" value="{{ old('meta.test_ip', data_get($item->meta ?? [], 'test_ip')) }}">
  </label>
  <label>Test URL
    <input type="text" name="meta[test_url]" value="{{ old('meta.test_url', data_get($item->meta ?? [], 'test_url')) }}">
  </label>
  <label>Приоритет (меньше — выше)
    <input type="number" name="meta[priority]" value="{{ old('meta.priority', data_get($item->meta ?? [], 'priority', 100)) }}">
  </label>
  <label class="row" style="grid-column:1/-1">
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
    Активна (доступна пользователям)
  </label>
  <label class="row" style="grid-column:1/-1">Заметки
    <textarea name="meta[notes]" rows="3">{{ old('meta.notes', data_get($item->meta ?? [], 'notes')) }}</textarea>
  </label>
</div>
<div class="form-actions" style="margin-top:14px">
  <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
  <a class="btn" href="{{ route('admin.locations.index') }}">{{ __('Cancel') }}</a>
</div>
