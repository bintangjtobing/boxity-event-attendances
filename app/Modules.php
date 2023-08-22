<?php

namespace App;

use App\ModuleGroups;
use App\Authorizations;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'modules';
    protected $fillable = [
        'module_group_id',
        'name',
        'order',
        'icon',
        'route',
        'is_shown',
        'type'
    ];

    public function ModuleGroup() {
        return $this->belongsTo(ModuleGroups::class, 'module_group_id');
    }

    public function Authorization() {
        return $this->hasMany(Authorizations::class, 'module_id');
    }
}
