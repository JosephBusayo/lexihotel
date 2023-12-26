<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "warehouse_id",
        "uid",
        "name",
        "cost_price",
        "selling_price",
        "quantity",
        "status",
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}