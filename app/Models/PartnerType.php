<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerType extends Model
{
    const STATUS_ACTIVE = 5;
    const STATUS_IN_ACTIVE = 6;


    const PAYMENT_GATEWAY = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
        'status'
    ];
}
