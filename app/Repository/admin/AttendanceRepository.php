<?php

namespace App\Repository\admin;

use App\Attendances;
use App\Participants;
use App\Events;
use Exception;

class AttendanceRepository
{
    function getEvent() {
        $data = Events::get();
        return $data;
    }

    function getSingleData($id) {
        $data = Attendances::find($id);
        return $data;
    }

    function getData($n) {
        $search = request('search');
        $event_id = request('event_id');
        $data = Participants::orderBy('participant_id', 'desc');
        if ($search) {
            $data = $data->where('name', 'like', '%' . $search . '%');
        }
        if ($event_id != 'all') {
            $data = $data->where('event_id', $event_id);
        }
        return $data->paginate($n);
    }

    function delete($id) {
        Attendances::find($id)->delete();
    }
}
