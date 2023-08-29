<?php
namespace App\Helper;

use App\ModuleGroups;
use App\Modules;
use App\ModulesUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

/**
 *
 */
class Helper
{
    public static function getSuperadminMenu()
    {
        $role_id = Auth::guard('superadmin')->user()->role_id;
        $menus = collect([]);

        $withoutSub = Modules::query()
        ->with(['Authorization' => function ($query) use ($role_id) {
            $query->where('role_id', $role_id)->where('authorization_type_id', 1);
        }])
        ->whereHas('Authorization', function ($query) use ($role_id) {
            $query->where('role_id', $role_id)->where('authorization_type_id', 1);
        })
        ->where('module_group_id', null)
        ->where('type', 1)
        ->orderBy('order', 'asc')
        ->get();
        $withSub = ModuleGroups::query()
        ->with(['Modules' => function ($query) use ($role_id) {
            $query->whereHas('Authorization', function ($query) use ($role_id) {
                $query->where('role_id', $role_id)->where('authorization_type_id', 1)->where('type', 1);
            });
        }])
        ->whereHas('Modules', function ($query) use ($role_id) {
            $query->whereHas('Authorization', function ($query) use ($role_id) {
                $query->where('role_id', $role_id)->where('authorization_type_id', 1)->where('type', 1);
            });
        })->get();
        foreach ($withSub as $ws) {
            $menus = $withoutSub->push($ws);
        }
        $array = collect($menus)->sortBy('order');
        return $array;
    }

    public static function getAdminMenu()
    {
        $role_id = Auth::guard('admin')->user()->role_id;
        $menus = collect([]);

        $withoutSub = Modules::query()
        ->with(['Authorization' => function ($query) use ($role_id) {
            $query->where('role_id', $role_id)->where('authorization_type_id', 1);
        }])
        ->whereHas('Authorization', function ($query) use ($role_id) {
            $query->where('role_id', $role_id)->where('authorization_type_id', 1);
        })
        ->where('module_group_id', null)
        ->orderBy('order', 'asc')
        ->where('type', 2)
        ->get();
        $withSub = ModuleGroups::query()
        ->with(['Modules' => function ($query) use ($role_id) {
            $query->whereHas('Authorization', function ($query) use ($role_id) {
                $query->where('role_id', $role_id)->where('authorization_type_id', 1)->where('type', 2);
            });
        }])
        ->whereHas('Modules', function ($query) use ($role_id) {
            $query->whereHas('Authorization', function ($query) use ($role_id) {
                $query->where('role_id', $role_id)->where('authorization_type_id', 1)->where('type', 2);
            });
        })->get();
        if (count($withSub) != 0) {
            foreach ($withSub as $ws) {
                $menus = $withoutSub->push($ws);
            }
        } else {
            $menus = $withoutSub;
        }
        return $menus;
    }

    public static function getCurrentUrl() {
        $currentUrl = url()->current();
        $implode = explode('/', $currentUrl);
        $currentUrl = $implode[4];
        return $currentUrl;
    }

    public static function getCurrentUrlAdmin() {
        $currentUrl = url()->current();
        $implode = explode('/', $currentUrl);
        $currentUrl = $implode[3];
        return $currentUrl;
    }

    public static function getCurrentRouteAdmin() {
        $currentUrl = url()->current();
        $implode = explode('/', $currentUrl);
        $currentUrl = $implode[3];
        $route = $currentUrl . '_view_index';
        return $route;
    }

    public static function  getCurrentRestaurant() {
        return Auth::guard('admin')->user()->Restaurant->name;
    }

    // For add'active' class for activated route nav-item
    public static function active_class($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

      // For checking activated route
    public static function is_active_route($path) {
        return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
    }

      // For add 'show' class for activated route collapse
    public static function show_class($path) {
        return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
    }

    public static function strReplace($str, $from, $to) {
        $str = str_replace($from, $to, $str);
        return $str;
    }

    public static function getSizes() {
        $sizes = [
            'XS' => 'XS',
            'S' => 'S',
            'M' => 'M',
            'L' => 'L',
            'XL' => 'XL',
            'XXL' => 'XXL',
            'XXXL' => 'XXXL'
        ];
        return $sizes;
    }

    public static function generateHash($input) {
        return md5($input);
    }

    public function getOriginalParticipantID($hashedParticipantID) {
        return md5_reverse($hashedParticipantID);
    }

    public static function verifyHash($input, $hashedValue) {
        $inputHash = md5($input);
        return $inputHash === $hashedValue;
    }
}
