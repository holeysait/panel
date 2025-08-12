@extends('admin.layouts.app')
@section('title','Редактировать сервер #'.$server->id)
@section('content')
<div class="admin-head">
    <h1>Редактировать сервер #{{ $server->id }}</h1>
</div>
<form method="post" action="{{ route('admin.servers.update',$server) }}" class="card form">
    @csrf @method('PUT')
    <div class="form-row">
        <label>Имя</label>
        <input type="text" name="name" value="{{ old('name',$server->name) }}">
        @error('name')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="form-row">
        <label>Статус</label>
        <select name="status">
            @foreach(['provisioning','ready','paused','error'] as $st)
                <option @selected(old('status',$server->status)===$st) value="{{ $st }}">{{ ucfirst($st) }}</option>
            @endforeach
        </select>
        @error('status')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="form-actions">
        <button class="btn">Сохранить</button>
        <a class="btn btn-light" href="{{ route('admin.servers.index') }}">Отмена</a>
    </div>
</form>
@endsection
