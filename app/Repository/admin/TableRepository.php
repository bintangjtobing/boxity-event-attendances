<?php

namespace App\Repository\admin;

use App\Tables;
use Exception;
use Illuminate\Support\Facades\Auth;

class TableRepository
{
    function getSingleData($id) {
        $data = Tables::find($id);
        return $data;
    }

    function getData($n) {
        $search = request('search');
        $data = Tables::orderBy('id', 'asc');
        if ($search) {
            $data = $data->where('name', 'like', '%' . $search . '%');
        }
        return $data->paginate($n);
    }

    function add() {
        $qrcode = bcrypt(request('name'));
        $data = [
            'restaurant_id' => Auth::guard('admin')->user()->restaurant_id,
            'name' => request('name'),
            'qrcode' => $qrcode
        ];
        Tables::create($data);
    }

    function update($id) {
        $qrcode = bcrypt(request('name'));
        $data = [
            'name' => request('name'),
            'qrcode' => $qrcode
        ];
        Tables::find($id)->update($data);
    }

    function delete($id) {
        Tables::find($id)->delete();
    }
}
