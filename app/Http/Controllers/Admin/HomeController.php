<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Total Users',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\User',
            'group_by_field'        => 'email_verified_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings1['total_number'] = 0;

        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where($settings1['filter_field'], '>=',
                        now()->subDays($settings1['filter_days'])->format('Y-m-d'));
                } else
                if (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                        case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                        case 'month':$start = date('Y-m') . '-01';break;
                        case 'year':$start  = date('Y') . '-01-01';break;
                    }

                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }

                }

            })
                ->{$settings1['aggregate_function'] ?? 'count'}
            ($settings1['aggregate_field'] ?? '*');
        }

        $settings2 = [
            'chart_title'           => 'Total Hospitals',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Hospital',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings2['total_number'] = 0;

        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where($settings2['filter_field'], '>=',
                        now()->subDays($settings2['filter_days'])->format('Y-m-d'));
                } else
                if (isset($settings2['filter_period'])) {
                    switch ($settings2['filter_period']) {
                        case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                        case 'month':$start = date('Y-m') . '-01';break;
                        case 'year':$start  = date('Y') . '-01-01';break;
                    }

                    if (isset($start)) {
                        return $query->where($settings2['filter_field'], '>=', $start);
                    }

                }

            })
                ->{$settings2['aggregate_function'] ?? 'count'}
            ($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => 'Total Radiologists',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Radiologist',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings3['total_number'] = 0;

        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where($settings3['filter_field'], '>=',
                        now()->subDays($settings3['filter_days'])->format('Y-m-d'));
                } else
                if (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                        case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                        case 'month':$start = date('Y-m') . '-01';break;
                        case 'year':$start  = date('Y') . '-01-01';break;
                    }

                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }

                }

            })
                ->{$settings3['aggregate_function'] ?? 'count'}
            ($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'           => 'Total Pending Reports',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\WorkOrder',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings4['total_number'] = 0;

        if (class_exists($settings4['model'])) {
            $settings4['total_number'] = $settings4['model']::when(isset($settings4['filter_field']), function ($query) use ($settings4) {
                if (isset($settings4['filter_days'])) {
                    return $query->where($settings4['filter_field'], '>=',
                        now()->subDays($settings4['filter_days'])->format('Y-m-d'));
                } else
                if (isset($settings4['filter_period'])) {
                    switch ($settings4['filter_period']) {
                        case 'week':$start  = date('Y-m-d', strtotime('last Monday'));break;
                        case 'month':$start = date('Y-m') . '-01';break;
                        case 'year':$start  = date('Y') . '-01-01';break;
                    }

                    if (isset($start)) {
                        return $query->where($settings4['filter_field'], '>=', $start);
                    }

                }

            })
                ->{$settings4['aggregate_function'] ?? 'count'}
            ($settings4['aggregate_field'] ?? '*');
        }

        $settings5 = [
            'chart_title'        => 'Study Status',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\\WorkOrder',
            'group_by_field'     => 'title',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
            'relationship_name'  => 'work_order_status',
        ];

        $chart5 = new LaravelChart($settings5);

        $settings6 = [
            'chart_title'        => 'Hospitals',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_string',
            'model'              => 'App\\Hospital',
            'group_by_field'     => 'title',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
        ];

        $chart6 = new LaravelChart($settings6);

        $settings7 = [
            'chart_title'        => 'Radiologists',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_string',
            'model'              => 'App\\Radiologist',
            'group_by_field'     => 'name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
        ];

        $chart7 = new LaravelChart($settings7);

        $settings8 = [
            'chart_title'        => 'Modalities',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_string',
            'model'              => 'App\\Modality',
            'group_by_field'     => 'title',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
        ];

        $chart8 = new LaravelChart($settings8);

        $settings9 = [
            'chart_title'           => 'Reports',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\WorkOrder',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        $chart9 = new LaravelChart($settings9);

        $settings10 = [
            'chart_title'        => 'Permissions',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_string',
            'model'              => 'App\\Permission',
            'group_by_field'     => 'title',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
        ];

        $chart10 = new LaravelChart($settings10);

        return view('home', compact('settings1', 'settings2', 'settings3', 'settings4', 'chart5', 'chart6', 'chart7', 'chart8', 'chart9', 'chart10'));
    }

}
