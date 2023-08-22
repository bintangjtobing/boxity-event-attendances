<?php

use App\Roles;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles::truncate();
        Roles::insert([
            [
                'id' => 1,
                'name' => 'superadmin',
                'type' => 1,
            ],
            [
                'id' => 2,
                'name' => 'master',
                'type' => 2,
            ],
        ]);
    }
}
