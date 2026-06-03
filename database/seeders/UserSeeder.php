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
        User::factory()->create([
            'no' => '0000001',
            'name' => 'rifqi',
            'email' => null,
            'password' => null,
        ]);

        User::factory()->create([
            'no' => '0000002',
            'name' => 'arya',
            'email' => 'arya@gmail.com',
            'password' => '121212',
        ]);
    }
}
