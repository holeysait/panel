<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationCampaign;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = NotificationCampaign::query()
            ->when($q, function($qq) use ($q){
                $qq->where('name','like',"%{$q}%");
            })
            ->orderBy('id','desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.notifications.index', compact('items','q'));
    }
}
