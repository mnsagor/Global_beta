<?php

use Illuminate\Database\Seeder;
use App\Modality;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modality = [
            [
                'id' => 1,
                'title' => 'DX',
                'status' => 1,
                'details' => 'This is sample details.',
//                'created_by_id' => 1,
            ],
            [
                'id' => 2,
                'title' => 'ECG',
                'status' => 1,
                'details' => 'This is sample details.',
//                'created_by_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Mammography',
                'status' => 1,
                'details' => 'This is sample details.',
//                'created_by_id' => 1,
            ],[
                'id' => 4,
                'title' => 'X-ray',
                'status' => 1,
                'details' => 'This is sample details.',
//                'created_by_id' => 1,
            ],
            [
                'id' => 5,
                'title' => 'MRI',
                'status' => 1,
                'details' => 'This is sample details.',
//                'created_by_id' => 1,
            ],
            [
                'id' => 6,
                'title' => 'CT Scan',
                'status' => 1,
                'details' => 'This is sample details.',
//                'created_by_id' => 1,
            ],
            [
                'id' => 7,
                'title' => 'MG',
                'status' => 1,
                'details' => 'This is sample details.',
//                'created_by_id' => 1,
            ],
            [
                'id' => 8,
                'title' => 'EEG',
                'status' => 1,
                'details' => 'This is sample details.',
//                'created_by_id' => 1,
            ],
        ];

        Modality::insert($modality);
    }
}
