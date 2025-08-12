<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller {
  protected array $keys = [
    'site_name' => 'string',
    'brand_color' => 'string',
    'currency' => 'string',
    'smtp_host' => 'string',
    'smtp_port' => 'int',
    'smtp_user' => 'string',
    'smtp_password' => 'secret',
    'recaptcha_site' => 'string',
    'recaptcha_secret' => 'secret',
  ];

  public function index() {
    $settings = Setting::whereIn('key', array_keys($this->keys))->get()->keyBy('key');
    return view('admin.settings.index', compact('settings'));
  }

  public function update(Request $r) {
    foreach ($this->keys as $key => $type) {
      $val = $r->input($key);
      if ($val === null) continue;
      Setting::updateOrCreate(['key'=>$key], ['value'=>$val, 'type'=>$type]);
    }
    return back()->with('ok','Настройки сохранены');
  }
}