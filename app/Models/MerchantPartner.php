<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantPartner extends Model
{
    const STATUS_ACTIVE = 13;
    const STATUS_IN_ACTIVE = 14;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merchant_partners';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'merchant_id',
        'partner_id',
        'status',
        'settings'
    ];
}
