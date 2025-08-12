@extends('layouts.app')

@section('content')
@php
    $vcss = file_exists(public_path('assets/admin.css')) ? filemtime(public_path('assets/admin.css')) : 1;
    $vjs = file_exists(public_path('assets/admin.js')) ? filemtime(public_path('assets/admin.js')) : 1;
@endphp
<link rel="stylesheet" href="{{ asset('assets/admin.css') }}?v={{ $vcss }}"/>

<div class="admin-grid">
    <aside class="admin-aside">
        <div class="admin-aside__brand">Admin</div>
        <nav class="admin-menu">
            <a href="{{ route('admin.dashboard') }}" class="admin-menu__item {{ request()->routeIs('admin.dashboard') ? 'is-active':'' }}">Главная</a>
            <div class="admin-menu__group">Управление</div>
            <a href="{{ route('admin.users.index') }}" class="admin-menu__item {{ request()->routeIs('admin.users.*') ? 'is-active':'' }}">Пользователи</a>
            <a href="{{ route('admin.locations.index') }}" class="admin-menu__item {{ request()->routeIs('admin.locations.*') ? 'is-active':'' }}">Локации</a>
            <a href="{{ route('admin.tariffs.index') }}" class="admin-menu__item {{ request()->routeIs('admin.tariffs.*') ? 'is-active':'' }}">Тарифы</a>
            <a href="{{ route('admin.addons.index') }}" class="admin-menu__item {{ request()->routeIs('admin.addons.*') ? 'is-active':'' }}">Дополнения</a>
            <a href="{{ route('admin.servers.index') }}" class="admin-menu__item {{ request()->routeIs('admin.servers.*') ? 'is-active':'' }}">Серверы</a>
            <div class="admin-menu__group">Коммуникации</div>
            <a href="{{ route('admin.promotions.index') }}" class="admin-menu__item {{ request()->routeIs('admin.promotions.*') ? 'is-active':'' }}">Акции</a>
            <a href="{{ route('admin.notifications.index') }}" class="admin-menu__item {{ request()->routeIs('admin.notifications.*') ? 'is-active':'' }}">Уведомления</a>
            <div class="admin-menu__group">Контент</div>
            <a href="{{ route('admin.news.index') }}" class="admin-menu__item {{ request()->routeIs('admin.news.*') ? 'is-active':'' }}">Новости</a>
            <a href="{{ route('admin.wiki.index') }}" class="admin-menu__item {{ request()->routeIs('admin.wiki.*') ? 'is-active':'' }}">Википедия</a>
            <a href="{{ route('admin.pages.index') }}" class="admin-menu__item {{ request()->routeIs('admin.pages.*') ? 'is-active':'' }}">Страницы</a>
            <div class="admin-menu__group">Служебное</div>
            <a href="{{ route('admin.logs.index') }}" class="admin-menu__item {{ request()->routeIs('admin.logs.*') ? 'is-active':'' }}">Логи</a>
            <a href="{{ route('admin.settings.index') }}" class="admin-menu__item {{ request()->routeIs('admin.settings.*') ? 'is-active':'' }}">Настройки</a>
        </nav>
    </aside>

    <section class="admin-content">
        @yield('admin-title')
        @includeIf('partials.flash')
        @yield('admin-content')
    </section>
</div>

<script src="{{ asset('assets/admin.js') }}?v={{ $vjs }}" defer></script>
@endsection
