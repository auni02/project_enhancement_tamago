<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name'];  // <-- Add this line

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
