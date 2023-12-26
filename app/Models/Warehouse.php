<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid', 'name', 'status', 'state_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'state_id');
    }
}