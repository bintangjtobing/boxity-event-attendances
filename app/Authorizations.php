<?php

namespace App;

use App\Roles;
use App\Modules;
use App\AuthorizationTypes;
use Illuminate\Database\Eloquent\Model;

class Authorizations extends Model
{
    protected $table = 'authorizations';
    protected $fillable = [
        'module_id',
        'authorization_type_id',
        'role_id',
        'type'
    ];

    public function Module() {
        return $this->belongsTo(Modules::class, 'module_id');
    }

    public function AuthorizationType() {
        return $this->belongsTo(AuthorizationTypes::class, 'authorization_type_id');
    }

    public function Role() {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
