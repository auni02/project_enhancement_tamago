<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'company_risk_id', // ✅ add this line
        'category',
        'risk_detail',
        'problem_description',
        'review_state', // ✅ Add this line
        'reported_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function mitigation()
    {
        return $this->hasOne(RiskMitigation::class);
    }

    public function evaluation()
    {
        return $this->hasOne(RiskEvaluation::class)->latestOfMany();
    }

}

