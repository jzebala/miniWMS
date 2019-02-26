<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User();

        $user->name = "Janusz";
        $user->email = 'j.zebala96@gmail.com';
        $user->password = bcrypt('secretpass');
        $user->save();

        $user->roles()->attach(1);
    }
}
