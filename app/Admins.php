<?php

namespace App;

use App\Roles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    use Notifiable;
    protected $table = 'admins';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo',
        'role_id'
    ];

    public function Role() {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
