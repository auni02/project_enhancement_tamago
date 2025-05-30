<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\RiskMitigation;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get tasks assigned to this staff
        $tasks = RiskMitigation::where('assigned_to', $user->id)
                    ->with('risk')
                    ->get();

        return view('staff.tasks.my_task', compact('tasks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'staff_solution' => 'nullable|string',
        ]);

        $task = RiskMitigation::findOrFail($id);

        // ✅ Ensure only assigned staff can update
        if ($task->assigned_to !== auth()->id()) {
            abort(403);
        }

        // ✅ Force status to Awaiting Approval when staff updates
        $task->status = 'Awaiting Approval';
        $task->staff_solution = $request->staff_solution;
        $task->admin_approved = false; // Reset approval flag
        $task->save();

        return back()->with('success', 'Task updated. Awaiting admin approval.');
    }

}

