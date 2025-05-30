<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskMitigation extends Model
{
    // Define the fillable properties for mass assignment
    protected $fillable = [
        'risk_id',
        'existing_control',
        'risk_treatment',
        'solution_details',
        'assigned_to',
        'status',
        'date_assigned',
    ];

    // Define the relationship with the Risk model
    public function risk()
    {
        return $this->belongsTo(Risk::class);
    }

    // Define the relationship with the User model (assigned staff)
    public function assignedStaff()
{
    return $this->belongsTo(User::class, 'assigned_to');
}

}
