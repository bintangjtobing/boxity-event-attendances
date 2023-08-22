<?php

namespace App\Repository\admin;

use App\Admins;
use App\Roles;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminRepository
{
    function getRoles() {
        $data = Roles::where('type', 2)->orderBy('name', 'asc');
        return $data->get();
    }

    function getSingleData($id) {
        $callback = function($role) {
            $role->where('type', 2);
        };
        $data = Admins::whereHas('Role', $callback)->find($id);
        return $data;
    }

    function getData($n) {
        $callback = function($role) {
            $role->where('type', 2);
        };
        $data = Admins::whereHas('Role', $callback)->orderBy('id', 'asc');
        return $data->paginate($n);
    }

    function add() {
        $data = [
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'role_id' => request('role_id'),
            'photo' => request('photo')
        ];
        Admins::create($data);
    }

    function update($id) {
        $data = [
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'role_id' => request('role_id'),
            'photo' => request('photo')
        ];
        Admins::find($id)->update($data);
    }

    function delete($id) {
        Admins::find($id)->delete();
    }
}
