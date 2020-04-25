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
            [
                'id'             => 2,
                'name'           => 'Asad',
                'email'          => 'asad@admin.com',
                'password'       => '$2y$10$IzE4I3YF8gkoYWzHGxi0Ue5xHCvqkdTcM3//Z22nUD9BAZvd0/GPa', //password
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 3,
                'name'           => 'Sagor',
                'email'          => 'sagor@admin.com',
                'password'       => '$2y$10$IzE4I3YF8gkoYWzHGxi0Ue5xHCvqkdTcM3//Z22nUD9BAZvd0/GPa', //password
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 4,
                'name'           => 'LABAID Diagnostic',
                'email'          => 'labaid@gmail.com',
                'password'       => '$2y$10$ubahBcgTP03rSbIx/5GlmeE9q0i5IBfgzgUZQaMYvfl0KvMk2GBx6', //12345678
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 5,
                'name'           => 'Dr. Masuma Zalil',
                'email'          => 'masuma@gmail.com',
                'password'       => '$2y$10$ubahBcgTP03rSbIx/5GlmeE9q0i5IBfgzgUZQaMYvfl0KvMk2GBx6', //12345678
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 6,
                'name'           => 'Popular Diagnostic',
                'email'          => 'popular@gmail.com',
                'password'       => '$2y$10$ubahBcgTP03rSbIx/5GlmeE9q0i5IBfgzgUZQaMYvfl0KvMk2GBx6', //12345678
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 7,
                'name'           => 'Dr. Tarana Halim',
                'email'          => 'tarana@gmail.com',
                'password'       => '$2y$10$ubahBcgTP03rSbIx/5GlmeE9q0i5IBfgzgUZQaMYvfl0KvMk2GBx6', //12345678
                'remember_token' => null,
                'approved'       => 1,
            ],

        ];

        User::insert($users);

    }
}
