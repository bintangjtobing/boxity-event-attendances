<?php

use App\Modules;
use App\Authorizations;
use App\AuthorizationTypes;
use Illuminate\Database\Seeder;

class AuthorizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [1,2];
        foreach ($type as $t) {
            $module = Modules::where('type', $t)->get();
            $auth_type = AuthorizationTypes::get();
            foreach ($module as $m) {
                foreach ($auth_type as $a) {
                    Authorizations::insert([
                        [
                            'module_id' => $m->id,
                            'authorization_type_id' => $a->id,
                            'role_id' => $t,
                            'type' => $t
                        ]
                    ]);
                }
            }
        }
    }
}
