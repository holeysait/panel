@extends('admin.layouts.app')
@section('admin-title')<h1>{{ __('Locations') }}</h1>@endsection
@section('admin-content')
<form method="get" class="form-actions" style="margin-bottom:10px">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('Search') }}">
  <button class="btn" type="submit">{{ __('Search') }}</button>
  <a class="btn btn-primary" href="{{ route('admin.locations.create') }}">{{ __('Create') }}</a>
</form>
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>{{ __('Name') }}</th>
      <th>Slug</th>
      <th>{{ __('Country') }}</th>
      <th>{{ __('City') }}</th>
      <th>{{ __('Status') }}</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $it)
      <tr>
        <td>{{ $it->id }}</td>
        <td><a href="{{ route('admin.locations.show', $it) }}">{{ $it->name }}</a></td>
        <td>{{ $it->slug }}</td>
        <td>{{ $it->country }}</td>
        <td>{{ $it->city }}</td>
        <td>{!! $it->is_active ? '<span class="badge bg-success">active</span>' : '<span class="badge bg-secondary">inactive</span>' !!}</td>
        <td>
          <a class="btn btn-sm" href="{{ route('admin.locations.edit', $it) }}">{{ __('Edit') }}</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
{{ $items->withQueryString()->links() }}
@endsection
