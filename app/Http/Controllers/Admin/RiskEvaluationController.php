<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Risk;
use App\Models\RiskEvaluation;

class RiskEvaluationController extends Controller
{
    public function store(Request $request, Risk $risk)
    {
        // Step 1: Validate the form inputs
        $data = $request->validate([
            'vulnerability' => 'required|integer|min:1|max:5',
            'impact' => 'required|integer|min:1|max:5',
            'likelihood' => 'required|integer|min:1|max:5',
        ]);

        // Step 2: Calculate the risk level
        $riskLevel = $data['vulnerability'] * $data['impact'] * $data['likelihood'];


        // Step 3: Store the evaluation in the DB
        RiskEvaluation::create([
            'risk_id' => $risk->id,
            'vulnerability' => $data['vulnerability'],
            'impact' => $data['impact'],
            'likelihood' => $data['likelihood'],
            'risk_level' => $riskLevel,
        ]);

        // Step 4: Mark the risk as Reviewed
        $risk->review_state = 'Reviewed';
        $risk->save();


        // Step 5: Redirect back with a success message
        return redirect()
            ->route('admin.risks.mitigation.create', $risk->id)
            ->with('calculated_level', $riskLevel) // 👈 Flash value to session
            ->with('success', 'Evaluation saved. Please complete risk mitigation details.');
    }



}

