<?php

namespace App\Models;

use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, UUIDTrait;
    protected $fillable = [
        'name',
        'category_id',
        'building_id',
        'floor_id',
        'price',
        'status',
        'intercom_mobile',
        'image',
        'description',
        'amenities',
        'user_id',
    ];

    /**
     * Defiining A Relationship
     * @Model  App\Models\User
     * @return USER OBJECT
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Defiining A Relationship
     * @Model  App\Models\Category
     * @return Category OBJECT
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Defiining A Relationship
     * @Model  App\Models\Building
     * @return Building OBJECT
     */
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * Defiining A Relationship
     * @Model  App\Models\Floor
     * @return Floor OBJECT
     */
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    /**
     * Defiining A Relationship
     * @Model  App\Models\Booking
     * @return Booking OBJECT
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function scopeOnlyAvailable($query)
    {
        return $query->where('is_available', 1);
    }

    public function scopeOnlyClean($query)
    {
        return $query->where('is_clean', 1);
    }

    public function scopeOnlyBooked($query)
    {
        return $query->where('is_booked', 1);
    }
}