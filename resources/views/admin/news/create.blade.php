@extends('admin.layouts.app')
@section('admin-title')<h1>news — создать</h1>@endsection
@section('admin-content')
<form method="post" action="{ route('admin.news.store') }" class="form-row">
@csrf
<label class="full">title<input type="text" name="title" value="{{ old("title", $item->title ?? "") }}" placeholder="Заголовок"/></label>\n<label class="full">slug<input type="text" name="slug" value="{{ old("slug", $item->slug ?? "") }}" placeholder="slug"/></label>\n<label class="full">excerpt<input type="text" name="excerpt" value="{{ old("excerpt", $item->excerpt ?? "") }}" placeholder="кратко"/></label>\n
<div class="form-actions full">
  <a href="{ route('admin.news.index') }" class="btn secondary">Отмена</a>
  <button class="btn">Сохранить</button>
</div>
</form>
@endsection
