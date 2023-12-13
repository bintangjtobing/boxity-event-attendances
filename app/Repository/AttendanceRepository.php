<?php

namespace App\Repository;

use Exception;
use Carbon\Carbon;
use App\Events;
use App\AdminStyles;
use App\Attendances;
use App\Certificates;
use App\Participants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class AttendanceRepository
{
    function getSingleEvent() {
        $data = Events::first();
        return $data;
    }
}