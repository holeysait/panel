@extends('admin.layouts.app')
@section('admin-title')<h1>wiki — редактировать #{ $item->id }</h1>@endsection
@section('admin-content')
<form method="post" action="{ route('admin.wiki.update', $item) }" class="form-row">
@csrf @method('PUT')
<label class="full">title<input type="text" name="title" value="{{ old("title", $item->title ?? "") }}" placeholder="Заголовок"/></label>\n<label class="full">slug<input type="text" name="slug" value="{{ old("slug", $item->slug ?? "") }}" placeholder="slug"/></label>\n<label class="full">tags<input type="text" name="tags" value="{{ old("tags", $item->tags ?? "") }}" placeholder="теги"/></label>\n
<div class="form-actions full">
  <a href="{ route('admin.wiki.index') }" class="btn secondary">Назад</a>
  <button class="btn">Обновить</button>
</div>
</form>
@endsection
