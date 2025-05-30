<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiskController extends Controller
{
    public function myReportedRisks()
    {
        $user = auth()->user();

        $risks = \App\Models\Risk::where('user_id', $user->id)->with('evaluation')->get();

        return view('staff.risks.my_history', compact('risks'));
    }
}
