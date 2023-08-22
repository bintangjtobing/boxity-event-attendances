<?php

namespace App\Repository\admin;

use App\Authorizations;
use App\AuthorizationTypes;
use App\Modules;
use App\Roles;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthorizationRepository
{
    function getRole() {
        $data = Roles::where('type', 2)->get();
        return $data;
    }

    function getMenu()
    {
        $data = Modules::where('type', 2)->get();
        return $data;
    }

    function getType()
    {
        $data = AuthorizationTypes::all();
        return $data;
    }

    function getData($id) {
        $data = Authorizations::where('role_id', $id)->where('type', 2)->get();
        return $data;
    }

    function update()
    {
        Authorizations::where('role_id', request('role'))->where('type', 2)->delete();
        $req = request('menu_tipe');
        $temp = [];
        foreach ($req as $val) {
            $exp = explode('_', $val);
            $ar['role_id'] = request('role');
            $ar['module_id'] =  $exp[0];
            $ar['authorization_type_id'] =  $exp[1];
            $ar['type'] = 2;
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
