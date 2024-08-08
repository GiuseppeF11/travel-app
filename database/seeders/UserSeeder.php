<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $users = [
            [
                'name' => 'Peppe',
                'email' => 'peppe@gmail.com',
                'password' => bcrypt('password1'),
            ],
            [
                'name' => 'Lucia',
                'email' => 'lucia@gmail.com',
                'password' => bcrypt('password2'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
