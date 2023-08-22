<?php

namespace App\Repository\superadmin;

use App\Purchases;
use App\Rents;
use Exception;

class PurchaseRentRepository
{
    function getSingleData($id) {
        $data = Purchases::find($id);
        return $data;
    }

    function getData($n) {
        $data = Purchases::orderBy('id', 'asc');
        return $data->paginate($n);
    }

    function add() {
        $timezone = 'Asia/Jakarta';
        $rent = Rents::find(request('rent_id'));
        $data = [
            'user_id' => request('user_id'),
            'restaurant_id' => request('restaurant_id'),
            'amount' => $rent->amount,
            'date' => \Carbon\Carbon::now($timezone)
        ];
        Purchases::create($data);
    }

    function update($id) {
        $rent = Rents::find(request('rent_id'));
        $data = [
            'user_id' => request('user_id'),
            'restaurant_id' => request('restaurant_id'),
            'amount' => $rent->amount,
        ];
        Purchases::find($id)->update($data);
    }
}
