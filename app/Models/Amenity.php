<?php

namespace App\Models;

use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory, UUIDTrait;
    protected $fillable = ['name', 'slug', 'status'];
}