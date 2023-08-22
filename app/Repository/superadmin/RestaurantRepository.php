<?php

namespace App\Repository\superadmin;

use App\Restaurants;
use Exception;

class RestaurantRepository
{
    function getSingleData($id) {
        $data = Restaurants::find($id);
        return $data;
    }

    function getData($n) {
        $data = Restaurants::orderBy('id', 'asc');
        return $data->paginate($n);
    }

    function add() {
        $data = [
            'amount' => request('amount'),
            'period' => request('period')
        ];
        Restaurants::create($data);
    }

    function update($id) {
        $data = [
            'amount' => request('amount'),
            'period' => request('period')
        ];
        Restaurants::find($id)->update($data);
    }

    function delete($id) {
        Restaurants::find($id)->delete();
    }
}
