@extends('admin.layouts.app')
@section('admin-title')<h1>Настройки панели</h1>@endsection
@section('admin-content')
<form method="post" action="{{ route('admin.settings.update') }}" class="form-row">
@csrf
<label>Бренд <input type="text" name="brand_name" value="{{ $values['brand_name'] ?? '' }}"/></label>
<label>Валюта (ISO) <input type="text" name="currency" value="{{ $values['currency'] ?? 'USD' }}"/></label>
<label>Налог % <input type="text" name="tax_percent" value="{{ $values['tax_percent'] ?? '' }}"/></label>
<label class="full">Базовый URL <input type="text" name="base_url" value="{{ $values['base_url'] ?? '' }}"/></label>
<label>SMTP хост <input type="text" name="smtp_host" value="{{ $values['smtp_host'] ?? '' }}"/></label>
<label>SMTP порт <input type="text" name="smtp_port" value="{{ $values['smtp_port'] ?? '' }}"/></label>
<label>SMTP пользователь <input type="text" name="smtp_user" value="{{ $values['smtp_user'] ?? '' }}"/></label>
<label>SMTP пароль <input type="password" name="smtp_pass" value="{{ $values['smtp_pass'] ?? '' }}"/></label>
<label>Шифрование <input type="text" name="smtp_encryption" value="{{ $values['smtp_encryption'] ?? '' }}"/></label>
<label>reCAPTCHA site <input type="text" name="recaptcha_site" value="{{ $values['recaptcha_site'] ?? '' }}"/></label>
<label>reCAPTCHA secret <input type="text" name="recaptcha_secret" value="{{ $values['recaptcha_secret'] ?? '' }}"/></label>
<div class="form-actions full">
  <button class="btn">Сохранить</button>
</div>
</form>
@endsection
