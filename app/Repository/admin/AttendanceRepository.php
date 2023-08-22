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
        $data = Participants::orderBy('participant_id', 'asc');
        if ($search) {
            $data = $data->where('name', 'like', '%' . $search . '%');
        }
        return $data->paginate($n);
    }

    function add() {
        dd(request());
        $data = [
            'name' => request('name'),
            'location' => request('location'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'start_time' => request('start_time'),
            'end_time' => request('end_time'),
            'link' => request('link')
        ];
        Attendances::create($data);
    }

    function update($id) {
        $data = [
            'name' => request('name'),
            'location' => request('location'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'start_time' => request('start_time'),
            'end_time' => request('end_time'),
            'link' => request('link')
        ];
        Attendances::find($id)->update($data);
    }

    function delete($id) {
        Attendances::find($id)->delete();
    }
}
