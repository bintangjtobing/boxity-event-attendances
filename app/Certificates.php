<?php

namespace App;

use App\Events;
use App\Participants;
use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    protected $table = 'certificates';
    protected $fillable = [
        'participant_id',
        'event_id',
        'status',
    ];

    public function Participant() {
        return $this->belongsTo(Participants::class, 'participant_id', 'participant_id');
    }

    public function Event() {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
