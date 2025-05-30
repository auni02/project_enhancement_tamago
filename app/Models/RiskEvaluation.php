<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskEvaluation extends Model
{
    protected $fillable = [
    'risk_id',
    'vulnerability',
    'impact',
    'likelihood',
    'risk_level',
    ];

    public function risk()
    {
        return $this->belongsTo(Risk::class);
    }

}
