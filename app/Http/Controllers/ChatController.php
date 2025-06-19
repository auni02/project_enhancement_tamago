<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
{
    $messages = Message::where('from_user_id', auth()->id())
                ->orWhere('to_user_id', auth()->id())
                ->orderBy('created_at')->get();

    return view('chat.index', compact('messages'));
}

public function send(Request $request)
{
    $request->validate([
        'to_user_id' => 'required|exists:users,id',
        'message' => 'required|string|max:1000',
    ]);

    Message::create([
        'from_user_id' => auth()->id(),
        'to_user_id' => $request->to_user_id,
        'message' => $request->message,
    ]);

    return back()->with('success', 'Message sent!');
}
}
