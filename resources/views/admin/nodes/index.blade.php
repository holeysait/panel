@extends('admin.layouts.app')
@section('admin-title')<h1>Узлы</h1>@endsection
@section('admin-content')
@if(session('ok'))<div class="alert alert-success">{{ session('ok') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
<table class="table">
  <thead><tr>
    <th>ID</th><th>Название</th><th>FQDN</th><th>Локация</th><th>Статус</th><th>last_seen</th><th style="width:260px">Действия</th>
  </tr></thead>
  <tbody>
  @foreach($items as $it)
    <tr>
      <td>{{ $it->id }}</td>
      <td><a href="{{ route('admin.nodes.edit', $it) }}">{{ $it->name }}</a></td>
      <td>{{ $it->public_fqdn }}</td>
      <td>{{ optional($it->location)->name ?? '-' }}</td>
      <td>{{ $it->status }}</td>
      <td>{{ $it->last_seen_at }}</td>
      <td>
        <a class="btn btn-sm" href="{{ route('admin.nodes.show', $it) }}">Открыть</a>
        <a class="btn btn-sm" href="{{ route('admin.nodes.onboarding', $it) }}">Подключить</a>
        <form method="post" action="{{ route('admin.nodes.ping', $it) }}" style="display:inline">@csrf
          <button class="btn btn-sm" type="submit">Проверить</button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
{{ $items->links() }}
@endsection
