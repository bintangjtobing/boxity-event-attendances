<?php

namespace App;

use App\Authorizations;
use Illuminate\Database\Eloquent\Model;

class AuthorizationTypes extends Model
{
    protected $table = 'authorization_types';
    protected $fillable = [
        'name',
        'type'
    ];

    public function Authorizations() {
        return $this->hasMany(Authorizations::class, 'authorization_type_id');
    }
}
