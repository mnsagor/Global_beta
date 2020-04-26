<?php

use Illuminate\Database\Seeder;
use App\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor = [
            [
                'id'             => 1,
                'name'           => 'Dr. Abdur Rashid',
                'gender'          => 1,
                'phone_number'       => '01912998874',
                'status' => 1,
                'created_by_id'       => 2,
            ],
        ];

        Doctor::insert($doctor);
    }
}
