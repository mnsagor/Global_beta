@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.hospital.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $hospital->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $hospital->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Hospital::STATUS_SELECT[$hospital->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.hospital_code') }}
                                    </th>
                                    <td>
                                        {{ $hospital->hospital_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.address') }}
                                    </th>
                                    <td>
                                        {!! $hospital->address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.manager_name') }}
                                    </th>
                                    <td>
                                        {{ $hospital->manager_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.manager_phone_number') }}
                                    </th>
                                    <td>
                                        {{ $hospital->manager_phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.techonologist_name') }}
                                    </th>
                                    <td>
                                        {{ $hospital->techonologist_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.technologist_phone_number') }}
                                    </th>
                                    <td>
                                        {{ $hospital->technologist_phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.receptionist_name') }}
                                    </th>
                                    <td>
                                        {{ $hospital->receptionist_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.receptionist_phone_number') }}
                                    </th>
                                    <td>
                                        {{ $hospital->receptionist_phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.route_title') }}
                                    </th>
                                    <td>
                                        {{ $hospital->route_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.route_ae_title') }}
                                    </th>
                                    <td>
                                        {{ $hospital->route_ae_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.route_host_name') }}
                                    </th>
                                    <td>
                                        {{ $hospital->route_host_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.route_port') }}
                                    </th>
                                    <td>
                                        {{ $hospital->route_port }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.pacs_destinaiton_ae_title') }}
                                    </th>
                                    <td>
                                        {{ $hospital->pacs_destinaiton_ae_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.pacs_ae_title') }}
                                    </th>
                                    <td>
                                        {{ $hospital->pacs_ae_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.pacs_host_name') }}
                                    </th>
                                    <td>
                                        {{ $hospital->pacs_host_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.pacs_port') }}
                                    </th>
                                    <td>
                                        {{ $hospital->pacs_port }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.proprietor_name') }}
                                    </th>
                                    <td>
                                        {{ $hospital->proprietor_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.proprietor_phone_number') }}
                                    </th>
                                    <td>
                                        {{ $hospital->proprietor_phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.chairman_name') }}
                                    </th>
                                    <td>
                                        {{ $hospital->chairman_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.chairman_phone_number') }}
                                    </th>
                                    <td>
                                        {{ $hospital->chairman_phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.director_name') }}
                                    </th>
                                    <td>
                                        {{ $hospital->director_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.director_phone_number') }}
                                    </th>
                                    <td>
                                        {{ $hospital->director_phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.accountant_name') }}
                                    </th>
                                    <td>
                                        {{ $hospital->accountant_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.accountant_phone_number') }}
                                    </th>
                                    <td>
                                        {{ $hospital->accountant_phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $hospital->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hospital.fields.modality') }}
                                    </th>
                                    <td>
                                        @foreach($hospital->modalities as $key => $modality)
                                            <span class="label label-info">{{ $modality->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
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
                        <a href="#hospital_work_orders" aria-controls="hospital_work_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.workOrder.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#hospital_radiologists" aria-controls="hospital_radiologists" role="tab" data-toggle="tab">
                            {{ trans('cruds.radiologist.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="hospital_work_orders">
                        @includeIf('admin.hospitals.relationships.hospitalWorkOrders', ['workOrders' => $hospital->hospitalWorkOrders])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="hospital_radiologists">
                        @includeIf('admin.hospitals.relationships.hospitalRadiologists', ['radiologists' => $hospital->hospitalRadiologists])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection