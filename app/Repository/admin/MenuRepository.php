<?php

namespace App\Repository\admin;

use App\Menus;
use Exception;
use Illuminate\Support\Facades\Auth;

class MenuRepository
{
    function getSingleData($id) {
        $data = Menus::find($id);
        return $data;
    }

    function getData($n) {
        $search = request('search');
        $data = Menus::orderBy('id', 'asc');
        if ($search) {
            $data = $data->where('name', 'like', '%' . $search . '%');
        }
        return $data->paginate($n);
    }

    function add() {
        $data = [
            'restaurant_id' => Auth::guard('admin')->user()->restaurant_id,
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'qty' => request('qty'),
        ];
        Menus::create($data);
    }

    function update($id) {
        $data = [
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'qty' => request('qty'),
        ];
        Menus::find($id)->update($data);
    }

    function delete($id) {
        Menus::find($id)->delete();
    }
}
