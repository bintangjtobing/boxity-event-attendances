<?php

use App\Admins;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admins::insert([
            [
                'name' => 'Superadmin',
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('superadmin'),
                'role_id' => 1,
            ],
            [
                'name' => 'Master',
                'username' => 'master',
                'email' => 'master@gmail.com',
                'password' => bcrypt('master'),
                'role_id' => 2,
            ],
        ]);
    }
}
