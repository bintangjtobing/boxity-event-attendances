<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            RolesSeeder::class,
            AdminSeeder::class,
            AuthorizationTypesSeeder::class,
            ModuleGroupsSeeder::class,
            ModulesSeeder::class,
            AuthorizationsSeeder::class,
            EventsSeeder::class,
            // ParticipantSeeder::class
        ]);
    }
}
