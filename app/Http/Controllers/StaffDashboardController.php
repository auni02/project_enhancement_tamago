<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
    $adminId = 1;                       // change to your real admin/super-admin id
    $messages = Message::where(function($q) use ($userId,$adminId){
            $q->where('from_user_id',$userId)->where('to_user_id',$adminId);
        })->orWhere(function($q) use ($userId,$adminId){
            $q->where('from_user_id',$adminId)->where('to_user_id',$userId);
        })
        ->with('sender')
        ->orderBy('created_at')
        ->get();

    $targetId = $adminId;               // pass to hidden field
    return view('staff.dashboard', compact('messages','targetId'));
    }

}
