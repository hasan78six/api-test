<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantProduct extends Model
{
    const STATUS_ACTIVE = 15;
    const STATUS_IN_ACTIVE = 16;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merchant_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'merchant_id',
        'product_id',
        'price',
        'status'
    ];

    public function detail(){
        return $this->belongsTo(Product::class, "product_id", "id")
            ->with("type:product_types.id,type");
    }
}
