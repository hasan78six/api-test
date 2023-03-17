<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merchant_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'merchant_id',
        'token',
        'company_name'
    ];
}
