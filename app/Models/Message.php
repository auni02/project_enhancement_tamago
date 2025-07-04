<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['from_user_id', 'to_user_id', 'message'];

    public function sender()
    {
        return $this->belongsTo(\App\Models\User::class, 'from_user_id');
}
}

