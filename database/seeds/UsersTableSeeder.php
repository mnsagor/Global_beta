<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$IzE4I3YF8gkoYWzHGxi0Ue5xHCvqkdTcM3//Z22nUD9BAZvd0/GPa',
                'remember_token' => null,
                'approved'       => 1,
            ],
        ];

        User::insert($users);

    }
}
