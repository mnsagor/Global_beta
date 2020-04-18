<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\\App\\WorkOrder',
            'date_field' => 'created_at',
            'field'      => 'id',
            'prefix'     => 'Report_',
            'suffix'     => '',
            'route'      => 'admin.work-orders.edit',
        ],
        [
            'model'      => '\\App\\Radiologist',
            'date_field' => 'created_at',
            'field'      => 'name',
            'prefix'     => 'Radiologists_',
            'suffix'     => '',
            'route'      => 'admin.radiologists.edit',
        ],
    ];

    public function index()
    {
        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }

        }

        return view('admin.calendar.calendar', compact('events'));

    }

}
