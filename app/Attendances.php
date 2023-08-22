<?php

namespace App;

use App\Events;
use App\Participants;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    protected $table = 'attendances';
    protected $fillable = [
        'event_id',
        'participant_id',
        'attendance_date',
        'attendance_time'
    ];

    public function Event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function Participant()
    {
        return $this->belongsTo(Participants::class, 'participant_id');
    }
}
