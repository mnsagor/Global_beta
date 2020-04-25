<?php

use Illuminate\Database\Seeder;
use App\Radiologist;

class RadiologistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $radiologist = [
            [
                'id'             => 1,
                'name'           => 'Dr. Masuma Zalil',
                'designation'           => 'Radiologist',
                'gender'   => 2,
                'status'        => 1,
                'created_by_id' => 3,
                'user_id'       => 5,
            ],
            [
                'id'             => 2,
                'name'           => 'Dr. Tarana Halim',
                'designation'           => 'Radiologist',
                'gender'   => 2,
                'status'        => 1,
                'created_by_id' => 2,
                'user_id'       => 7,
            ],
        ];

        Radiologist::insert($radiologist);
    }
}
