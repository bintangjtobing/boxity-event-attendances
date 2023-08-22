<?php

namespace App\Repository\admin;

use App\Orders;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    function getSingleData($id) {
        $data = Orders::find($id);
        return $data;
    }

    function getData($n) {
        $search = request('search');
        $data = Orders::orderBy('id', 'asc');
        if ($search) {
            $data = $data->where('order_number', 'like', '%' . $search . '%');
        }
        return $data->paginate($n);
    }

    function add() {
        $timezone = 'Asia/Jakarta';
        $data = [
            'restaurant_id' => Auth::guard('admin')->user()->restaurant_id,
            'table_id' => request('table_id'),
            'order_number' => request('order_number'),
            'order_time' => \Carbon\Carbon::now($timezone),
            'status' => request('status'),
        ];
        Orders::create($data);
    }

    function update($id) {
        $data = [
            'name' => request('name'),
        ];
        Orders::find($id)->update($data);
    }

    function delete($id) {
        Orders::find($id)->delete();
    }
}
