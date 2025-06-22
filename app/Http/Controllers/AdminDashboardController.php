<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $adminId = auth()->id();

    // pick the last staff who chatted with admin, or 0 if none
    $lastMsg = Message::where('from_user_id',$adminId)
              ->orWhere('to_user_id',$adminId)->latest()->first();
    $targetId = $lastMsg ? ($lastMsg->from_user_id == $adminId ? $lastMsg->to_user_id : $lastMsg->from_user_id) : 0;

    $messages = $targetId
        ? Message::where(function($q) use ($adminId,$targetId){
                $q->where('from_user_id',$adminId)->where('to_user_id',$targetId);
            })->orWhere(function($q) use ($adminId,$targetId){
                $q->where('from_user_id',$targetId)->where('to_user_id',$adminId);
            })->with('sender')->orderBy('created_at')->get()
        : collect();

    return view('admin.dashboard', compact('messages','targetId'));
}
}
