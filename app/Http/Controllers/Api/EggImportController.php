<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
class EggImportController extends Controller {
    public function import(Request $req) {
        $url = $req->input('url');
        if (!$url) return response()->json(['error'=>'url is required'], 422);
        Artisan::call('eggs:import', ['url'=>$url]);
        return response()->json(['status'=>'queued_or_done','output'=>Artisan::output()]);
    }
}