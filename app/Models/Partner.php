<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    const STATUS_ACTIVE = 7;
    const STATUS_IN_ACTIVE = 8;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
        'status'
    ];
}
