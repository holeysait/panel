<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(string $locale, Request $request)
    {
        if (!in_array($locale, ['ru','en'])) {
            abort(404);
        }
        $request->session()->put('locale', $locale);
        return redirect()->back();
    }
}
