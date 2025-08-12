<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class LogsController extends Controller {
  public function index(Request $r) {
    $q = $r->string('q')->toString();
    $action = $r->string('action')->toString();
    $items = AuditLog::query()
      ->when($action, fn($qq)=>$qq->where('action',$action))
      ->when($q, fn($qq)=>$qq->where('meta->message','like',"%$q%"))
      ->latest('created_at')
      ->paginate(50)->withQueryString();
    return view('admin.logs.index', compact('items','q','action'));
  }
}