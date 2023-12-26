<?php

namespace App\Models;

use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory, UUIDTrait;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
