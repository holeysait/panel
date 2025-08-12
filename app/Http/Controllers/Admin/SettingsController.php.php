<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $keys = [
            'brand_name','currency','tax_percent','smtp_host','smtp_port','smtp_user','smtp_pass','smtp_encryption',
            'recaptcha_site','recaptcha_secret','base_url'
        ];
        $values = [];
        foreach ($keys as $k) $values[$k] = Setting::getValue($k, '');
        return view('admin.settings.index', ['values'=>$values]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'brand_name'=>'nullable|max:100',
            'currency'=>'nullable|size:3',
            'tax_percent'=>'nullable|numeric|min:0|max:99.99',
            'smtp_host'=>'nullable|max:255',
            'smtp_port'=>'nullable|integer|min:1|max:65535',
            'smtp_user'=>'nullable|max:255',
            'smtp_pass'=>'nullable|max:255',
            'smtp_encryption'=>'nullable|in:tls,ssl,none',
            'recaptcha_site'=>'nullable|max:255',
            'recaptcha_secret'=>'nullable|max:255',
            'base_url'=>'nullable|max:255',
        ]);
        foreach ($data as $k=>$v) \App\Models\Setting::setValue($k, $v ?? '');
        return back()->with('ok', 'Settings saved');
    }
}
