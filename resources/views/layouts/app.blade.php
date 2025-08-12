<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'BSPANel')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900">
  <nav class="bg-white border-b sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ route('dashboard') }}" class="font-bold">BSPANel</a>
      <div class="flex items-center gap-4">
        @auth
          <a href="{{ route('servers.index') }}" class="hover:underline">Серверы</a>
          <a href="{{ route('wallet.index') }}" class="hover:underline">Кошелёк</a>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button class="px-3 py-1 rounded bg-slate-900 text-white">Выйти</button>
          </form>
        @endauth
        @guest
          <a href="{{ route('login') }}" class="hover:underline">Войти</a>
          <a href="{{ route('register') }}" class="hover:underline">Регистрация</a>
        @endguest
      </div>
    </div>
  </nav>
  <main class="max-w-7xl mx-auto px-4 py-6">
    @yield('content')
  </main>
</body>
</html>
