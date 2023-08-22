<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'type'
    ];

    public function Admins() {
        return $this->hasMany(Admins::class, 'role_id');
    }

    public function Authorizations() {
        return $this->hasMany(Authorizations::class, 'role_id');
    }
}
