@extends('admin.layouts.app')

@section('admin-title')
<h1>Подключить узел: {{ $node->name }}</h1>
@endsection

@section('admin-content')
@if(session('ok'))
  <div class="alert alert-success">{{ session('ok') }}</div>
@endif

<div class="card"><div class="card-body">
  <h3>1) Сгенерируйте токен</h3>
  <form method="post" action="{{ route('admin.nodes.onboarding.token', $node) }}" style="margin-bottom:12px">@csrf
    <button class="btn btn-primary" type="submit">Сгенерировать токен</button>
  </form>
  @if($tokenPlain)
    <div class="alert alert-warning">
      <strong>Токен агента (сохраните сейчас — потом не будет показан):</strong>
      <code style="user-select:all">{{ $tokenPlain }}</code>
    </div>
  @endif
</div></div>

<div class="card" style="margin-top:12px"><div class="card-body">
  <h3>2) Подготовьте сервер (SSH)</h3>
  <p>Выполните на узле (Ubuntu 22.04/24.04):</p>
  <pre><code>apt update &amp;&amp; apt -y upgrade
apt install -y curl ufw ca-certificates docker.io nginx</code></pre>

  <h4>UFW</h4>
  <pre><code>{{ $ufw }}</code></pre>

  <h4>Nginx (TLS + проксирование на агент)</h4>
  <pre><code>{{ $nginx }}</code></pre>
</div></div>

<div class="card" style="margin-top:12px"><div class="card-body">
  <h3>3) Создайте конфиг агента</h3>
  <p>Скопируйте в <code>/etc/panel-agent.env</code>:</p>
  <pre><code>@foreach($env as $k=>$v){{ $k }}={{ $v }}
@endforeach</code></pre>

  <h4>systemd unit</h4>
  <p>Сохраните в <code>/etc/systemd/system/panel-agent.service</code>:</p>
  <pre><code>{{ $systemd }}</code></pre>

  <p>Затем:</p>
  <pre><code>systemctl daemon-reload
systemctl enable --now panel-agent
systemctl status panel-agent --no-pager</code></pre>

  <div class="alert alert-info" style="margin-top:8px">
    Примечание: бинарник <code>/usr/local/bin/panel-agent</code> должен быть установлен на узле.
    На следующем шаге добавим загрузку бинарника из репозитория/хранилища.
  </div>
</div></div>

<div class="card" style="margin-top:12px"><div class="card-body">
  <h3>4) Проверка</h3>
  <ul>
    <li>Health: <code>curl -k {{ $panelUrl }}/agent/health</code></li>
    <li>Админка → Узлы: статус должен смениться на <strong>online</strong> после подключения агента</li>
  </ul>
</div></div>

<div class="form-actions" style="margin-top:12px">
  <a class="btn" href="{{ route('admin.nodes.index') }}">Назад к узлам</a>
</div>
@endsection
