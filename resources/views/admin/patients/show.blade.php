@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.patient.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $patient->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $patient->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.gender') }}
                                    </th>
                                    <td>
                                        {{ App\Patient::GENDER_RADIO[$patient->gender] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.dof') }}
                                    </th>
                                    <td>
                                        {{ $patient->dof }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $patient->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $patient->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.nid') }}
                                    </th>
                                    <td>
                                        {{ $patient->nid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.clinical_history') }}
                                    </th>
                                    <td>
                                        {!! $patient->clinical_history !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.surgical_history') }}
                                    </th>
                                    <td>
                                        {!! $patient->surgical_history !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.lab_results') }}
                                    </th>
                                    <td>
                                        {{ $patient->lab_results }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.deo_comments') }}
                                    </th>
                                    <td>
                                        {!! $patient->deo_comments !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.clinical_diagnosis') }}
                                    </th>
                                    <td>
                                        {!! $patient->clinical_diagnosis !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.patient.fields.files') }}
                                    </th>
                                    <td>
                                        @foreach($patient->files as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
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
                        <a href="#patient_work_orders" aria-controls="patient_work_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.workOrder.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="patient_work_orders">
                        @includeIf('admin.patients.relationships.patientWorkOrders', ['workOrders' => $patient->patientWorkOrders])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection