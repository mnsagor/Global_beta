<?php

use Illuminate\Database\Seeder;
use App\WorkOrderStatus;


class WorkOrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workOrderStatus = [
            [
                'id' => 1,
                'title' => 'Unassigned',
                'created_by_id' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Ready to Read',
                'created_by_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Read in Progress',
                'created_by_id' => 1,
            ],
            [
                'id' => 4,
                'title' => 'Correction Unassigned',
                'created_by_id' => 1,
            ],
            [
                'id' => 5,
                'title' => 'Correction Ready to Read',
                'created_by_id' => 1,
            ],
            [
                'id' => 6,
                'title' => 'Correction Read in Progress',
                'created_by_id' => 1,
            ],
            [
                'id' => 7,
                'title' => 'Complete',
                'created_by_id' => 1,
            ],
        ];

        WorkOrderStatus::insert($workOrderStatus);
    }
}
