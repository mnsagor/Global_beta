@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.doctor.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.doctors.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $doctor->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $doctor->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.designation') }}
                                    </th>
                                    <td>
                                        {{ $doctor->designation }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.specilities') }}
                                    </th>
                                    <td>
                                        {{ $doctor->specilities }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.department') }}
                                    </th>
                                    <td>
                                        {{ $doctor->department }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.nid') }}
                                    </th>
                                    <td>
                                        {{ $doctor->nid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.gender') }}
                                    </th>
                                    <td>
                                        {{ App\Doctor::GENDER_RADIO[$doctor->gender] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $doctor->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $doctor->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Doctor::STATUS_SELECT[$doctor->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.address') }}
                                    </th>
                                    <td>
                                        {!! $doctor->address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.special_achievement') }}
                                    </th>
                                    <td>
                                        {!! $doctor->special_achievement !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.history') }}
                                    </th>
                                    <td>
                                        {!! $doctor->history !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.doctors.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#doctor_work_orders" aria-controls="doctor_work_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.workOrder.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="doctor_work_orders">
                        @includeIf('admin.doctors.relationships.doctorWorkOrders', ['workOrders' => $doctor->doctorWorkOrders])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection