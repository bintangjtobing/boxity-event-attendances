<?php

namespace App\Repository\superadmin;

use App\Roles;
use Exception;

class RoleRepository
{
    function getSingleData($id) {
        $data = Roles::where('id', $id)->first();
        return $data;
    }

    function getData($n) {
        $data = Roles::orderBy('id', 'asc');
        return $data->paginate($n);
    }

    function add() {
        $data = [
            'name' => request('name'),
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
