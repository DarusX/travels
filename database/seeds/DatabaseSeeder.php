<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Status;

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
    }
}
