<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::insert([
            [
                'name' => 'guest',
                'email' => 'guest@gmail.com',
                'password' => bcrypt('guest123'),
            ],
        ]);
    }
}
