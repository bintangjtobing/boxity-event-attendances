<?php

use App\Modules;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Modules::truncate();
        Modules::insert([
            //superadmin module
            [
                'module_group_id' => null,
                'name' => 'Dashboard',
                'order' => 1,
                'icon' => 'home',
                'route' => 'dashboard',
                'type' => 1,
                'is_shown' => 1
            ],
            //admin module
            [
                'module_group_id' => null,
                'name' => 'Dashboard',
                'order' => 1,
                'icon' => 'home',
                'route' => 'dashboard',
                'type' => 2,
                'is_shown' => 1
            ],
            [
                'module_group_id' => null,
                'name' => 'Event',
                'order' => 2,
                'icon' => 'server',
                'route' => 'event',
                'type' => 2,
                'is_shown' => 1
            ],
            [
                'module_group_id' => null,
                'name' => 'Participant',
                'order' => 3,
                'icon' => 'users',
                'route' => 'participant',
                'type' => 2,
                'is_shown' => 1
            ],
            [
                'module_group_id' => null,
                'name' => 'Attendance',
                'order' => 4,
                'icon' => 'user-check',
                'route' => 'attendance',
                'type' => 2,
                'is_shown' => 1
            ],
            [
                'module_group_id' => null,
                'name' => 'Certificate',
                'order' => 5,
                'icon' => 'file-text',
                'route' => 'certificate',
                'type' => 2,
                'is_shown' => 1
            ],
            [
                'module_group_id' => 2,
                'name' => 'Role',
                'order' => null,
                'icon' => null,
                'route' => 'role',
                'type' => 2,
                'is_shown' => 1
            ],
            [
                'module_group_id' => 2,
                'name' => 'Admin',
                'order' => null,
                'icon' => null,
                'route' => 'admin',
                'type' => 2,
                'is_shown' => 1
            ],
            [
                'module_group_id' => 2,
                'name' => 'Authorization',
                'order' => null,
                'icon' => null,
                'route' => 'authorization',
                'type' => 2,
                'is_shown' => 1
            ],
        ]);
    }
}
