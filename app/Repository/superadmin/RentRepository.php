<?php

namespace App\Repository\superadmin;

use App\Rents;
use Exception;

class RentRepository
{
    function getSingleData($id) {
        $data = Rents::find($id);
        return $data;
    }

    function getData($n) {
        $data = Rents::orderBy('id', 'asc');
        return $data->paginate($n);
    }

    function add() {
        $data = [
            'amount' => request('amount'),
            'period' => request('period')
        ];
        Rents::create($data);
    }

    function update($id) {
        $data = [
            'amount' => request('amount'),
            'period' => request('period')
        ];
        Rents::find($id)->update($data);
    }

    function delete($id) {
        Rents::find($id)->delete();
    }
}
