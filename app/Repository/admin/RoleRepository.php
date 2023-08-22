<?php

namespace App\Repository\admin;

use App\Roles;
use Exception;

class RoleRepository
{
    function getSingleData($id) {
        $data = Roles::where('type', 2)->where('id', $id)->first();
        return $data;
    }

    function getData($n) {
        $data = Roles::where('type', 2)->orderBy('id', 'asc');
        return $data->paginate($n);
    }

    function add() {
        $data = [
            'name' => request('name'),
            'type' => 2
        ];
        Roles::create($data);
    }

    function update($id) {
        $data = [
            'name' => request('name'),
        ];
        Roles::find($id)->update($data);
    }

    function delete($id) {
        Roles::where('id', $id)->delete();
    }
}
