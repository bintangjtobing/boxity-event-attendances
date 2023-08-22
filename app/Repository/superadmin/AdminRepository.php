<?php

namespace App\Repository\superadmin;

use Exception;
use App\Roles;
use App\Admins;

class AdminRepository
{
    function getRoles() {
        $data = Roles::get();
        return $data;
    }

    function getSingleData($id) {
        $data = Admins::find($id);
        return $data;
    }

    function getData($n) {
        $data = Admins::orderBy('id', 'asc');
        return $data->paginate($n);
    }

    function add() {
        $data = [
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'role_id' => request('role_id'),
        ];
        Admins::create($data);
    }

    function update($id) {
        $data = [
            'name' => request('name'),
            'email' => request('email'),
            'role_id' => request('role_id'),
        ];
        Admins::find($id)->update($data);
    }

    function delete($id) {
        Admins::find($id)->delete();
    }
}
