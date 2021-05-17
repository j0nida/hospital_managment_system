<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shift;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'password' => "$2y$10\$UpPMm5Lj.9pqK40RW.SJIOTC6FI3XXaWVx.O1Qxyb5B12HDHE1R3G"
        ]);

        User::factory(10)->create();
            
        Shift::create([
            'shift_name' => 'turni i pare',
            'shift_start_time' => '08:00:00',
            'shift_end_time' => '16:00:00',
        ]);
        Shift::create([
            'shift_name' => 'turni i dyte',
            'shift_start_time' => '16:00:00',
            'shift_end_time' => '24:00:00',
        ]);
        Shift::create([
            'shift_name' => 'turni i trete',
            'shift_start_time' => '24:00:00',
            'shift_end_time' => '08:00:00',
        ]);
    }
}
