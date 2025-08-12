<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BSPANEL')</title>
    @php
        $cssPath = public_path('assets/app.css');
        $jsPath = public_path('assets/app.js');
        $v = file_exists($cssPath) ? filemtime($cssPath) : time();
        $vj = file_exists($jsPath) ? filemtime($jsPath) : time();
    @endphp
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}?v={{ $v }}">
</head>
<body>
<header class="nav">
  <div class="container nav-inner">
    <a class="brand" href="{{ auth()->check() ? route('dashboard') : url('/') }}">BSPANEL</a>

    <button class="burger" aria-label="Menu" onclick="window.toggleMenu()">
      <span></span><span></span><span></span>
    </button>

    <nav class="menu" id="top-menu">
      @auth
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Дашборд</a>
        <a href="{{ route('servers.index') }}" class="{{ request()->is('servers') ? 'active' : '' }}">Серверы</a>
        <a href="{{ route('wallet.index') }}" class="{{ request()->is('wallet') ? 'active' : '' }}">Кошелёк</a>
        <a href="{{ route('settings.index') }}" class="{{ request()->is('settings') ? 'active' : '' }}">Настройки</a>
      @endauth
    </nav>

    <div class="nav-right">
      @guest
        <a class="btn ghost" href="{{ route('login') }}">Войти</a>
        <a class="btn primary" href="{{ route('register') }}">Регистрация</a>
      @endguest
      @auth
        <span class="hello">Привет, {{ \Illuminate\Support\Str::limit(auth()->user()->name ?? auth()->user()->email, 18) }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn primary" type="submit">Выйти</button>
        </form>
      @endauth
    </div>
  </div>
</header>

<main class="container section">
  @includeIf('partials.flash')
  @yield('content')
</main>

<footer class="footer">
  <div class="container">© {{ date('Y') }} BSPANEL</div>
</footer>

<script src="{{ asset('assets/app.js') }}?v={{ $vj }}"></script>
</body>
</html>
