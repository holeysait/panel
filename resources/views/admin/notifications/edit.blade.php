@extends('admin.layouts.app')
@section('admin-title')<h1>notifications — редактировать #{ $item->id }</h1>@endsection
@section('admin-content')
<form method="post" action="{ route('admin.notifications.update', $item) }" class="form-row">
@csrf @method('PUT')
<label class="full">name<input type="text" name="name" value="{{ old("name", $item->name ?? "") }}" placeholder="Название"/></label>\n<label class="full">channel<input type="text" name="channel" value="{{ old("channel", $item->channel ?? "") }}" placeholder="inapp/email"/></label>\n<label class="full">subject<input type="text" name="subject" value="{{ old("subject", $item->subject ?? "") }}" placeholder="Тема"/></label>\n<label class="full">status<input type="text" name="status" value="{{ old("status", $item->status ?? "") }}" placeholder="draft/scheduled/canceled"/></label>\n
<div class="form-actions full">
  <a href="{ route('admin.notifications.index') }" class="btn secondary">Назад</a>
  <button class="btn">Обновить</button>
</div>
</form>
@endsection
