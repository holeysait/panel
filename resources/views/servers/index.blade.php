@extends('layouts.app')
@section('content')
@if(session('ok'))<div class="alert alert-success">{{ session('ok') }}</div>@endif
<h1>Мои серверы</h1>
<p><a class="btn btn-primary" href="{{ route('servers.create') }}">Создать сервер</a></p>
<table class="table">
  <thead><tr><th>ID</th><th>UUID</th><th>Название</th><th>Узел</th><th>Статус</th></tr></thead>
  <tbody>
  @foreach($items as $it)
  <tr>
    <td>{{ $it->id }}</td>
    <td>{{ $it->uuid }}</td>
    <td>{{ $it->name }}</td>
    <td>{{ optional($it->node)->name ?? '-' }}</td>
    <td>{{ $it->status }}</td>
  </tr>
  @endforeach
  </tbody>
</table>
{{ $items->links() }}
@endsection
