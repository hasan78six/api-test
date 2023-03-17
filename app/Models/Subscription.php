<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 17;
    const STATUS_PENDING = 18;
    const STATUS_CANCELLED = 19;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscriptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'merchant_product_id', 'user_id', 'merchant_partner', 'renew_date', 'expires_at', 'transaction_id', "status"
    ];
}
