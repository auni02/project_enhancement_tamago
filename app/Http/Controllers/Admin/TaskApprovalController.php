<?php

namespace App\Http\Controllers\Admin;
use App\Models\RiskMitigation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskApprovalController extends Controller
{
    public function approve($id)
    {
        $task = RiskMitigation::findOrFail($id);

        // Only approve tasks that are waiting for approval
        if ($task->status === 'Awaiting Approval') {
            $task->status = 'Completed';
            $task->admin_approved = true;
            $task->save();

            return back()->with('success', 'Task approved and marked as completed.');
        }

        return back()->with('error', 'Task is not in a state to approve.');
    }
}
