@extends('admin.layouts.app')
@section('admin-title')<h1>locations — редактировать #{ $item->id }</h1>@endsection
@section('admin-content')
<form method="post" action="{ route('admin.locations.update', $item) }" class="form-row">
@csrf @method('PUT')
<label class="full">name<input type="text" name="name" value="{{ old("name", $item->name ?? "") }}" placeholder="Название"/></label>\n<label class="full">slug<input type="text" name="slug" value="{{ old("slug", $item->slug ?? "") }}" placeholder="slug"/></label>\n<label class="full">country<input type="text" name="country" value="{{ old("country", $item->country ?? "") }}" placeholder="страна"/></label>\n<label class="full">city<input type="text" name="city" value="{{ old("city", $item->city ?? "") }}" placeholder="город"/></label>\n
<div class="form-actions full">
  <a href="{ route('admin.locations.index') }" class="btn secondary">Назад</a>
  <button class="btn">Обновить</button>
</div>
</form>
@endsection
