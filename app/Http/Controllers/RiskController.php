<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Risk;
use Illuminate\Support\Facades\Auth;
use App\Models\RiskEvaluation;

class RiskController extends Controller
{
    public function create()
    {
        return view('staff.logrisk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'risk_detail' => 'required|string|max:255',
            'problem_description' => 'required|string',
            'reported_date' => 'required|date',
        ]);

        $user = auth()->user();

        // ✅ Get the last risk ID for this company
        $latestCompanyRiskId = Risk::where('company_id', $user->company_id)->max('company_risk_id') ?? 0;

        // ✅ Create risk record with incremented local ID
        Risk::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'company_risk_id' => $latestCompanyRiskId + 1,
            'category' => $request->category,
            'risk_detail' => $request->risk_detail,
            'problem_description' => $request->problem_description,
            'reported_date' => $request->reported_date,
            'review_state' => 'New', // ✅ Default value when reported
        ]);

        return redirect()->route('staff.logrisk')->with('success', 'Risk report successfully sent to admin.');
    }

    public function indexForAdmin(Request $request)
    {
        $admin = auth()->user();
        $filter = $request->query('review_state');

        $query = Risk::whereHas('user', function ($q) use ($admin) {
            $q->where('company_id', $admin->company_id);
        });

        if ($filter && in_array($filter, ['New', 'Reviewed'])) {
            $query->where('review_state', $filter);
        }

        $risks = $query->latest()->with('user')->get();

        return view('admin.risks.index', compact('risks', 'filter'));
    }

    public function evaluate(Request $request, Risk $risk)
{
    $data = $request->validate([
        'vulnerability' => 'required|integer|min:1|max:5',
        'impact' => 'required|integer|min:1|max:5',
        'likelihood' => 'required|integer|min:1|max:5',
    ]);

    $riskLevel = $data['vulnerability'] * $data['impact'] * $data['likelihood'];

    RiskEvaluation::create([
        'risk_id' => $risk->id,
        'vulnerability' => $data['vulnerability'],
        'impact' => $data['impact'],
        'likelihood' => $data['likelihood'],
        'risk_level' => $riskLevel,
    ]);

    $risk->review_state = 'Reviewed';
    $risk->save();

    return redirect()
        ->route('admin.risks.mitigation.create', $risk->id)
        ->with('calculated_level', $riskLevel)
        ->with('success', 'Evaluation saved. Please complete risk mitigation details.');
}


}
