<?php

namespace App\Models;

use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, UUIDTrait;

    protected $fillable = [
        'per_night',
        'checkin',
        'checkout',
        'amount',
        'room_id',
        'trx',
        'customer_id',
        'booking_option',
        'payment_type',
        'duration',
        'status',
        'user_id',
        'created_at'
    ];

    /**
     * Defiining A Relationship
     * @Model  App\Models\Building
     * @return ROOM CLASS
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Defiining A Relationship
     * @Model  App\Models\Building
     * @return CUSTOMER CLASS
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Defiining A Relationship
     * @Model  App\Models\Building
     * @return CUSTOMER CLASS
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOnlyReserved($query)
    {
        return $query->where('status', 2);
    }
}
