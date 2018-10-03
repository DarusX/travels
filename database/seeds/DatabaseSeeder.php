<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Status;
use App\Travel;
use Carbon\Carbon;
use App\Timezone;

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
        Status::create(['status' => 'Pending']);
        Status::create(['status' => 'Working']);
        Status::create(['status' => 'Done']);

        foreach (timezone_identifiers_list() as $timezone)
        {
            Timezone::create(['timezone' => $timezone]);
        }

        User::create([
            'name' => 'Fabián Montero',
            'email' => 'mntr.rdrgz@gmail.com',
            'password' => bcrypt('123456')
        ])->travels()->create([
            'travel' => 'Thailand',
            'budget' => 30000,
            'start_datetime' => Carbon::parse('2018-12-18 10:00:00'),
            'end_datetime' => Carbon::parse('2019-01-04 05:00:00'),
            'start_timezone_id' => Timezone::whereTimezone('America/Mexico_City')->first()->id,
            'end_timezone_id' => Timezone::whereTimezone('America/Mexico_City')->first()->id,
        ]);
    }
}
