<?php

use App\Events;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Events::insert([
            [
                'name' => 'Rakernas I dan Sarasehan ABPPTSI',
                'location' => 'Medan',
                'start_date' => '2023-08-31',
                'end_date' => '2023-09-01',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'link' => 'rakernas-I-dan-sarasehan-abpptsi'
            ],
        ]);
    }
}
