<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Michael Nabil',
            'email' => 'michaelnabil926@gmail.com',
            'phone' => '966512345678',
            'password' => 'password',
        ]);
    }
}
