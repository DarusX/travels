<?php

use Illuminate\Database\Seeder;
use App\User;

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
    }
}
