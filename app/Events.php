<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'is_active',
        'is_deleted'
    ];
}
