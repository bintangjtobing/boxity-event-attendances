<?php

namespace App\Repository\admin;

use App\Attendances;
use App\Participants;
use Exception;

class AttendanceRepository
{
    function getSingleData($id) {
        $data = Attendances::find($id);
        return $data;
    }

    function getData($n) {
        $search = request('search');
        $data = Participants::orderBy('participant_id', 'desc');
        if ($search) {
            $data = $data->where('name', 'like', '%' . $search . '%');
        }
        return $data->paginate($n);
    }

    function delete($id) {
        Attendances::find($id)->delete();
    }
}