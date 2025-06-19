<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class StaffDashboardController extends Controller
{
    public function index()
    {
        checkRole('staff'); // ✅ still apply your role check here

        $messages = \App\Models\Message::where('from_user_id', auth()->id())
                    ->orWhere('to_user_id', auth()->id())
                    ->with('sender')
                    ->orderBy('created_at')
                    ->get();

        return view('staff.dashboard', compact('messages'));
    }

}
