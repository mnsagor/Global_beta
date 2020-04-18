<?php

use App\AssetStatus;
use Illuminate\Database\Seeder;

class AssetStatusTableSeeder extends Seeder
{
    public function run()
    {
        $assetStatuses = [
            [
                'id'         => '1',
                'name'       => 'Available',
                'created_at' => '2020-04-18 16:27:57',
                'updated_at' => '2020-04-18 16:27:57',
            ],
            [
                'id'         => '2',
                'name'       => 'Not Available',
                'created_at' => '2020-04-18 16:27:57',
                'updated_at' => '2020-04-18 16:27:57',
            ],
            [
                'id'         => '3',
                'name'       => 'Broken',
                'created_at' => '2020-04-18 16:27:57',
                'updated_at' => '2020-04-18 16:27:57',
            ],
            [
                'id'         => '4',
                'name'       => 'Out for Repair',
                'created_at' => '2020-04-18 16:27:57',
                'updated_at' => '2020-04-18 16:27:57',
            ],
        ];

        AssetStatus::insert($assetStatuses);

    }
}
