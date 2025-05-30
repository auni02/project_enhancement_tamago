<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PendingUserController extends Controller
{
    public function index()
{
    $pendingUsers = User::where('is_approved', 0)->get();
    $approvedUsers = User::where('is_approved', 1)->get();
    $rejectedUsers = User::where('is_approved', -1)->get();

    return view('superadmin.pending-users', compact('pendingUsers', 'approvedUsers', 'rejectedUsers'));
}

public function approve(User $user)
{
    $user->is_approved = 1;
    $user->save();

    return redirect()->route('pending.users')->with('success', 'User approved successfully.');
}

public function reject(User $user)
{
    $user->is_approved = -1;
    $user->save();

    return redirect()->route('pending.users')->with('error', 'User rejected.');
}

}
