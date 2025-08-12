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
            ->when($q, fn($qq)=>$qq->where('name','like',"%$q%"))
            ->orderBy('id','desc')->paginate(20)->withQueryString();
        return view('admin.notifications.index', compact('items','q'));
    }

    public function create(){ return view('admin.notifications.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|max:255',
            'channel'=>'required|in:inapp,email',
            'subject'=>'nullable|max:255',
            'body'=>'required',
            'status'=>'required|in:draft,scheduled,canceled',
            'scheduled_at'=>'nullable|date',
        ]);
        NotificationCampaign::create($data);
        return redirect()->route('admin.notifications.index')->with('ok','Created');
    }

    public function edit(NotificationCampaign $notification)
    {
        return view('admin.notifications.edit', ['item'=>$notification]);
    }

    public function update(Request $request, NotificationCampaign $notification)
    {
        $data = $request->validate([
            'name'=>'required|max:255',
            'channel'=>'required|in:inapp,email',
            'subject'=>'nullable|max:255',
            'body'=>'required',
            'status'=>'required|in:draft,scheduled,canceled',
            'scheduled_at'=>'nullable|date',
        ]);
        $notification->update($data);
        return redirect()->route('admin.notifications.index')->with('ok','Updated');
    }

    public function destroy(NotificationCampaign $notification)
    {
        $notification->delete();
        return back()->with('ok','Deleted');
    }
}
