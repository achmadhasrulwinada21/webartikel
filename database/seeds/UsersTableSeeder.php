<?php

use App\User;
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
        $user = new User();
        $user->name             = "admin";
        $user->jabatan          = "admin";
        $user->password         = bcrypt("admin");
        $user->email            = "admin@mail.com";
        $user->save();
    }
}
