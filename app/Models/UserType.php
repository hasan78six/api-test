<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_IN_ACTIVE = 2;

    const MERCHANT = 1;
    const USER = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type', 'status'
    ];
}
