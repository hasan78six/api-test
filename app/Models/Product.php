<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const STATUS_ACTIVE = 11;
    const STATUS_IN_ACTIVE = 12;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'product_type',
        'status',
        "created_at",
        "updated_at"
    ];

    public function type()
    {
        return $this->belongsTo(ProductType::class, "product_type", "id");
    }
}
