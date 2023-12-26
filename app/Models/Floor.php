<?php

namespace App\Models;

use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory, UUIDTrait;

    protected $fillable = ['name', 'status', 'building_id'];

    /**
     * Defiining A Relationship
     * @Model  App\Models\Building
     * @return Building OBJECT
     */
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
