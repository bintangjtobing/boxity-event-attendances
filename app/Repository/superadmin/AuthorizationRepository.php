<?php

namespace App\Repository\superadmin;

use App\Authorizations;
use App\AuthorizationTypes;
use App\Modules;
use App\Rents;
use App\Roles;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthorizationRepository
{
    function getRole() {
        $data = Roles::get();
        return $data;
    }

    function getMenu()
    {
        $data = Modules::get();
        return $data;
    }

    function getType()
    {
        $data = AuthorizationTypes::all();
        return $data;
    }

    function getData($id) {
        $data = Authorizations::where('role_id', $id)->get();
        return $data;
    }

    function update()
    {
        Authorizations::where('role_id', request('role'))->delete();
        $req = request('menu_tipe');
        $temp = [];
        foreach ($req as $val) {
            $exp = explode('_', $val);
            $ar['role_id'] = request('role');
            $ar['module_id'] =  $exp[0];
            $ar['authorization_type_id'] =  $exp[1];
            $temp[] = $ar;
        }
        $auth = Authorizations::insert($temp);
        $data = [
            'id' => request('role'),
            'data' => json_encode($temp)
        ];
        return $data;
    }
}
