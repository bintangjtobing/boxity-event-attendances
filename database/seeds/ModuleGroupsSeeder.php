<?php

use App\ModuleGroups;
use Illuminate\Database\Seeder;

class ModuleGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ModuleGroups::truncate();
        ModuleGroups::insert([
            //superadmin module group
            [
                'name' => 'User & Authorization',
                'order' => 1,
                'icon' => 'settings',
                'type' => 1,
            ],
            //admin module group
            [
                'name' => 'User & Authorization',
                'order' => 1,
                'icon' => 'settings',
                'type' => 2,
            ],
        ]);
    }
}
