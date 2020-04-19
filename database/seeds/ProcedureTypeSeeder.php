<?php

use Illuminate\Database\Seeder;
use App\ProcedureType;

class ProcedureTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedureType = [
            [
                'id' => 1,
                'title' => 'Single Procedure',
                'created_by_id' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Both View Procedure',
                'created_by_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Contrast',
                'created_by_id' => 1,
            ],
        ];

        ProcedureType::insert($procedureType);
    }
}
