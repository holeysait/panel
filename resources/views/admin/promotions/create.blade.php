@extends('admin.layouts.app')
@section('admin-title')<h1>promotions — создать</h1>@endsection
@section('admin-content')
<form method="post" action="{ route('admin.promotions.store') }" class="form-row">
@csrf
<label class="full">name<input type="text" name="name" value="{{ old("name", $item->name ?? "") }}" placeholder="Название"/></label>\n<label class="full">code<input type="text" name="code" value="{{ old("code", $item->code ?? "") }}" placeholder="Код"/></label>\n<label class="full">type<input type="text" name="type" value="{{ old("type", $item->type ?? "") }}" placeholder="percent/fixed"/></label>\n<label class="full">value<input type="text" name="value" value="{{ old("value", $item->value ?? "") }}" placeholder="значение"/></label>\n
<div class="form-actions full">
  <a href="{ route('admin.promotions.index') }" class="btn secondary">Отмена</a>
  <button class="btn">Сохранить</button>
</div>
</form>
@endsection
