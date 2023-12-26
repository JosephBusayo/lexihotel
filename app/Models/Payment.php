<?php

namespace App\Models;

use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, UUIDTrait;

    protected $fillable = [
        'name',
        'trx',
        'booking_id',
        'amount',
        'user_id',
        'customer_id',
    ];

    // public function booking()
    // {
    //     return $this->belongsTo(Booking::class);
    // }
}