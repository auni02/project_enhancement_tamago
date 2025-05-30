<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use App\Models\RiskMitigation;
use App\Models\User;
use Illuminate\Http\Request;

class RiskMitigationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user || !$user->company_id) {
            abort(403, 'Unauthorized or missing company.');
        }

        $riskMitigations = \App\Models\RiskMitigation::where('status', '!=', 'Completed') // ✅ EXCLUDE completed
            ->whereHas('risk', function ($query) use ($user) {
                $query->where('company_id', $user->company_id);
            })
            ->with('risk.company', 'assignedStaff')
            ->get();

        return view('admin.mitigation.index', compact('riskMitigations'));
    }


    public function create(Risk $risk)
    {

        $staffs = User::where('company_id', $risk->company_id)
                  ->where('role', 'staff')
                  ->get();

        return view('admin.mitigation.create', compact('risk', 'staffs'));
    }

    public function store(Request $request, $riskId)
    {
        $validated = $request->validate([
            'existing_control' => 'nullable|string',
            'risk_treatment' => 'required|in:avoidance,mitigation,transfer,acceptance',
            'solution_details' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:Pending,Awaiting Approval,Completed',
            'date_assigned' => 'nullable|date',
        ]);

        // ✅ Fetch the full Risk model with its evaluation
        $risk = \App\Models\Risk::with('evaluation')->findOrFail($riskId);
        $admin = auth()->user();

        // ✅ Prevent admins from creating mitigation for other companies' risks
        if ($risk->company_id !== $admin->company_id) {
            abort(403, 'Unauthorized mitigation attempt.');
        }

        $mitigation = new \App\Models\RiskMitigation($validated);
        $mitigation->risk_id = $risk->id;
        $mitigation->risk_level = $risk->evaluation->risk_level ?? null;
        $mitigation->save();

        return redirect()->route('admin.risks.mitigation')->with('success', 'Risk mitigation saved successfully!');
    }

    public function edit($id)
    {
        $mitigation = RiskMitigation::with('risk')->findOrFail($id);
        $admin = auth()->user();

        // Ensure the mitigation belongs to the same company
        if ($mitigation->risk->company_id !== $admin->company_id) {
            abort(403, 'Unauthorized access.');
        }

        $staffs = \App\Models\User::where('company_id', $admin->company_id)
                ->where('role', 'staff')
                ->get();

        return view('admin.mitigation.edit', compact('mitigation', 'staffs'));
    }

    public function update(Request $request, $id)
    {
        $mitigation = RiskMitigation::with('risk')->findOrFail($id);
        $admin = auth()->user();

        if ($mitigation->risk->company_id !== $admin->company_id) {
            abort(403, 'Unauthorized update attempt.');
        }

        $validated = $request->validate([
            'existing_control' => 'nullable|string',
            'risk_treatment' => 'required|in:avoidance,mitigation,transfer,acceptance',
            'solution_details' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:Pending,Completed',
            'date_assigned' => 'nullable|date',
        ]);

        $mitigation->update($validated);

        return redirect()->route('admin.risks.mitigation')->with('success', 'Risk mitigation updated successfully!');
    }

    public function completed(Request $request)
    {
        $user = auth()->user();

        if (!$user || !$user->company_id) {
            abort(403, 'Unauthorized or missing company.');
        }

        $filter = $request->input('filter'); // risk level
        $staffId = $request->input('staff');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $completedTasks = RiskMitigation::where('status', 'Completed')
            ->whereHas('risk', function ($query) use ($user) {
                $query->where('company_id', $user->company_id);
            })
            ->when($filter, function ($query, $filter) {
                $query->where(function ($q) use ($filter) {
                    if ($filter === 'low') {
                        $q->where('risk_level', '<', 20);
                    } elseif ($filter === 'medium') {
                        $q->whereBetween('risk_level', [20, 49]);
                    } elseif ($filter === 'high') {
                        $q->where('risk_level', '>=', 50);
                    }
                });
            })
            ->when($staffId, function ($query, $staffId) {
                $query->where('assigned_to', $staffId);
            })
            ->when($dateFrom, function ($query, $dateFrom) {
                $query->whereDate('date_assigned', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query, $dateTo) {
                $query->whereDate('date_assigned', '<=', $dateTo);
            })
            ->with(['risk.company', 'assignedStaff'])
            ->get();

        // For dropdown staff filter
        $staffList = User::where('company_id', $user->company_id)
            ->where('role', 'staff')
            ->get();

        return view('admin.tasks.completed', compact('completedTasks', 'filter', 'staffId', 'dateFrom', 'dateTo', 'staffList'));
    }


}

