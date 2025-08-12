{{-- actions --}}
<div style="display:flex; gap:8px; margin-bottom:12px;">
  <a class="btn" href="{{ route('admin.nodes.onboarding', $item) }}">Страница подключения</a>
  <form method="post" action="{{ route('admin.nodes.ping', $item) }}" style="display:inline">
    @csrf
    <button class="btn" type="submit">Проверить подключение</button>
  </form>
</div>
