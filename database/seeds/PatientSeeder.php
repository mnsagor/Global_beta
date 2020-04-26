<?php

use Illuminate\Database\Seeder;
use App\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = [
            [
            'id'             => 1,
            'name'           => 'Md. Kamruzzaman Shoibal',
            'gender'          => 1,
            'phone_number'       => '01912998574',
            'created_by_id'       => 2,
            ],
        ];

        Patient::insert($patients);

    }
}
