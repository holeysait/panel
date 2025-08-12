@php
$items = [
  ['route'=>'admin.dashboard','label'=>'Главная'],
  ['route'=>'admin.users.index','label'=>'Пользователи'],
  ['route'=>'admin.locations.index','label'=>'Локации'],
  ['route'=>'admin.tariffs.index','label'=>'Тарифы'],
  ['route'=>'admin.addons.index','label'=>'Дополнения'],
  ['route'=>'admin.servers.index','label'=>'Серверы'],
  ['route'=>'admin.promotions.index','label'=>'Акции'],
  ['route'=>'admin.notifications.index','label'=>'Уведомления'],
  ['route'=>'admin.news.index','label'=>'Новости'],
  ['route'=>'admin.wiki.index','label'=>'Википедия'],
  ['route'=>'admin.pages.index','label'=>'Страницы'],
  ['route'=>'admin.logs.index','label'=>'Логи'],
  ['route'=>'admin.settings.index','label'=>'Настройки'],
];
@endphp
<nav class="admin-tabs">
  @foreach($items as $it)
    <a href="{{ route($it['route']) }}"
       class="admin-tab {{ request()->routeIs($it['route'].'*') ? 'is-active' : '' }}">
       {{ $it['label'] }}
    </a>
  @endforeach
</nav>
