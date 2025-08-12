@extends('admin.layouts.app')
@section('admin-title')<h1>{{ __('Locations') }} — {{ $item->name }}</h1>@endsection
@section('admin-content')
<div class="card">
  <div class="card-body">
    <dl class="grid" style="display:grid;grid-template-columns: 200px 1fr;gap:8px">
      <dt>ID</dt><dd>{{ $item->id }}</dd>
      <dt>Slug</dt><dd>{{ $item->slug }}</dd>
      <dt>Country</dt><dd>{{ $item->country }}</dd>
      <dt>City</dt><dd>{{ $item->city }}</dd>
      <dt>Status</dt><dd>{!! $item->is_active ? '<span class="badge bg-success">active</span>' : '<span class="badge bg-secondary">inactive</span>' !!}</dd>
      <dt>Meta</dt><dd><pre style="white-space:pre-wrap">{{ json_encode($item->meta, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre></dd>
    </dl>
    <div class="form-actions" style="margin-top:12px">
      <a class="btn btn-primary" href="{{ route('admin.locations.edit', $item) }}">{{ __('Edit') }}</a>
      <a class="btn" href="{{ route('admin.locations.index') }}">{{ __('Back') }}</a>
    </div>
  </div>
</div>
@endsection


<hr>
<h3>Список узлов</h3>
<table class="table">
  <thead><tr><th>ID</th><th>Название</th><th>FQDN</th><th>Status</th></tr></thead>
  <tbody>
  @foreach(($item->nodes ?? []) as $n)
    <tr>
      <td>{{ $n->id }}</td>
      <td>{{ $n->name }}</td>
      <td>{{ $n->public_fqdn }}</td>
      <td>{{ $n->status }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
