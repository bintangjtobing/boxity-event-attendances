<?php

namespace App;

use App\Modules;
use Illuminate\Database\Eloquent\Model;

class ModuleGroups extends Model
{
    protected $table = 'module_groups';
    protected $fillable = [
        'name',
        'order',
        'icon',
        'is_shown',
        'type'
    ];

    public function Modules() {
        return $this->hasMany(Modules::class, 'module_group_id');
    }
}
