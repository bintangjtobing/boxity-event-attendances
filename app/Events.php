<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'name',
        'location',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'token',
        'status',
        'cover_path',
        'description',
        'payment_link',
    ];
}