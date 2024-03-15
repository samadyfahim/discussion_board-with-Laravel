<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "fahim";
        $user->email = "fahim@gmail.com";
        $user->password = bcrypt("password");
        $user->save();


        User::factory()->count(10)->create();
    }
}
