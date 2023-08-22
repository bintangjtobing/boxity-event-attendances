<?php

namespace App\Repository\admin;

use App\Events;
use Exception;

class EventRepository
{
    function getSingleData($id) {
        $data = Events::find($id);
        return $data;
    }

    function getData($n) {
        $search = request('search');
        $data = Events::orderBy('id', 'asc');
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
        Events::create($data);
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
        Events::find($id)->update($data);
    }

    function delete($id) {
        Events::find($id)->delete();
    }
}
