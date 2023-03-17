<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantUser extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merchant_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'merchant_id',
        'user_id'
    ];
}
