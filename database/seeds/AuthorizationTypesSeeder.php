<?php

use App\AuthorizationTypes;
use Illuminate\Database\Seeder;

class AuthorizationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // AuthorizationTypes::truncate();
        $name = [
            'view',
            'add',
            'edit',
            'delete',
        ];

        for ($i=0; $i < count($name); $i++) {
            AuthorizationTypes::insert([
                [
                    'name' => $name[$i],
                ],
            ]);
        }
    }
}
