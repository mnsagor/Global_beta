<?php

use Illuminate\Database\Seeder;
use App\Procedure;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedure = [
            [
                'id' => 1,
                'title' => 'CHEST B/V',
                'status' => 1,
                'modality_id' => 1,
                'procedure_type_id' => 2,
//                'created_by_id' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Lumber Spine Lat',
                'status' => 1,
                'modality_id' => 1,
                'procedure_type_id' => 1,
//                'created_by_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Nasal Bone B/V',
                'status' => 1,
                'modality_id' => 1,
                'procedure_type_id' => 3,
//                'created_by_id' => 1,
            ],
            [
                'id' => 4,
                'title' => 'WRIST JOINT B/V',
                'status' => 1,
                'modality_id' => 2,
                'procedure_type_id' => 2,
//                'created_by_id' => 1,
            ],
            [
                'id' => 5,
                'title' => 'FOREARM WITH WRIST JOINT B/V',
                'status' => 1,
                'modality_id' => 2,
                'procedure_type_id' => 1,
//                'created_by_id' => 1,
            ],
            [
                'id' => 6,
                'title' => 'ARM RT B/V',
                'status' => 1,
                'modality_id' => 3,
                'procedure_type_id' => 3,
//                'created_by_id' => 1,
            ],
            [
                'id' => 7,
                'title' => 'ABDOMEN A/P SUPINE',
                'status' => 1,
                'modality_id' => 4,
                'procedure_type_id' => 2,
//                'created_by_id' => 1,
            ],
            [
                'id' => 8,
                'title' => 'D/L SPINE B/V',
                'status' => 1,
                'modality_id' => 5,
                'procedure_type_id' => 1,
//                'created_by_id' => 1,
            ],
            [
                'id' => 9,
                'title' => 'THORACIC SPINE B/V',
                'status' => 1,
                'modality_id' => 6,
                'procedure_type_id' => 3,
//                'created_by_id' => 1,
            ],
        ];

        Procedure::insert($procedure);
    }
}
