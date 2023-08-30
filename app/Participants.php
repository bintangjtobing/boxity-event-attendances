<?php

namespace App;

use App\Events;
use App\Attendances;
use App\Certificates;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    protected $table = 'participants';
    protected $guarded = [];

    public function Event() {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function Attendance() {
        return $this->hasMany(Attendances::class, 'participant_id', 'participant_id');
    }

    public function Certificate() {
        return $this->hasOne(Certificates::class, 'participant_id', 'participant_id');
    }
}
