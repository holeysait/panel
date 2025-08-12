@extends('admin.layouts.app')
@section('admin-title')<h1>tariffs — редактировать #{ $item->id }</h1>@endsection
@section('admin-content')
<form method="post" action="{ route('admin.tariffs.update', $item) }" class="form-row">
@csrf @method('PUT')
<label class="full">name<input type="text" name="name" value="{{ old("name", $item->name ?? "") }}" placeholder="Название"/></label>\n<label class="full">slug<input type="text" name="slug" value="{{ old("slug", $item->slug ?? "") }}" placeholder="slug"/></label>\n<label class="full">price_minor<input type="text" name="price_minor" value="{{ old("price_minor", $item->price_minor ?? "") }}" placeholder="цена (minor)"/></label>\n<label class="full">currency<input type="text" name="currency" value="{{ old("currency", $item->currency ?? "") }}" placeholder="валюта ISO"/></label>\n<label class="full">period<input type="text" name="period" value="{{ old("period", $item->period ?? "") }}" placeholder="hour/day/month"/></label>\n
<div class="form-actions full">
  <a href="{ route('admin.tariffs.index') }" class="btn secondary">Назад</a>
  <button class="btn">Обновить</button>
</div>
</form>
@endsection
