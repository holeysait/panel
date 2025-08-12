@extends('admin.layouts.app')
@section('admin-title')<h1>addons — редактировать #{ $item->id }</h1>@endsection
@section('admin-content')
<form method="post" action="{ route('admin.addons.update', $item) }" class="form-row">
@csrf @method('PUT')
<label class="full">name<input type="text" name="name" value="{{ old("name", $item->name ?? "") }}" placeholder="Название"/></label>\n<label class="full">code<input type="text" name="code" value="{{ old("code", $item->code ?? "") }}" placeholder="code"/></label>\n<label class="full">unit<input type="text" name="unit" value="{{ old("unit", $item->unit ?? "") }}" placeholder="единица"/></label>\n<label class="full">unit_price_minor<input type="text" name="unit_price_minor" value="{{ old("unit_price_minor", $item->unit_price_minor ?? "") }}" placeholder="цена за ед. (minor)"/></label>\n<label class="full">currency<input type="text" name="currency" value="{{ old("currency", $item->currency ?? "") }}" placeholder="валюта ISO"/></label>\n
<div class="form-actions full">
  <a href="{ route('admin.addons.index') }" class="btn secondary">Назад</a>
  <button class="btn">Обновить</button>
</div>
</form>
@endsection
