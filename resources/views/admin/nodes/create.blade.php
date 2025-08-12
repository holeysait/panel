@extends('admin.layouts.app')
@section('admin-title')<h1>Узлы — Создать</h1>@endsection
@section('admin-content')
<form method="post" action="{{ route('admin.nodes.store') }}" class="form-row">
  @include('admin.nodes._form', ['item'=>null, 'locations'=>$locations])
</form>
@endsection
