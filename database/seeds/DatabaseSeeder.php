<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Status;
use App\Travel;

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
        User::create([
            'name' => 'Fabián Montero',
            'email' => 'mntr.rdrgz@gmail.com',
            'password' => bcrypt('123456')
        ]);

        Status::create(['status' => 'Pending']);
        Status::create(['status' => 'Working']);
        Status::create(['status' => 'Done']);

        Travel::create([
            'travel' => 'Wonderland',
            'budget' => 100000,
            'start_date' => '2018-10-01',
            'end_date' => '2018-10-30',
        ]);
    }
}
