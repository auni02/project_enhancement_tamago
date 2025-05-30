<?php

namespace App\Http\Controllers\Admin;
use App\Models\RiskMitigation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function completedTasks()
{
    $admin = auth()->user();

    // Get tasks with status 'Completed' and approved by admin
    $completedTasks = RiskMitigation::whereHas('risk', function ($query) use ($admin) {
            $query->where('company_id', $admin->company_id);
        })
        ->where('status', 'Completed')
        ->where('admin_approved', true)
        ->with(['risk', 'assignedStaff'])
        ->get();

    return view('admin.tasks.completed', compact('completedTasks'));
}

}
