<?php

use Illuminate\Database\Seeder;
use App\Hospital;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hospital = [
            [
                'id'             => 1,
                'title'           => 'LABAID Diagnostic',
                'status'        => 1,
                'created_by_id' => 3,
                'user_id'       => 4,
            ],
            [
                'id'             => 2,
                'title'           => 'Popular Diagnostic',
                'status'        => 1,
                'created_by_id' => 2,
                'user_id'       => 6,
            ],
        ];

        Hospital::insert($hospital);
    }
}
