<?php

namespace App;

use App\Events;
use App\Attendances;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    protected $table = 'participants';
    protected $fillable = [
        'participant_id',
        'event_id',
        'name',
        'jabatan',
        'no_hp',
        'instansi',
        'alamat_instansi',
        'tanggal_kedatangan',
        'penginapan',
        'tanggal_kembali',
        'qr_code',
    ];

    public function Event() {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function Attendance() {
        return $this->hasMany(Attendances::class, 'participant_id', 'participant_id');
    }
}
