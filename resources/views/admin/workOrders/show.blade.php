@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.workOrder.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.work-orders.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.registration_number') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->registration_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.work_order_status') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->work_order_status->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.uploaded_by') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->uploaded_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.data') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.hospital') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->hospital->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.doctor') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->doctor->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.patient') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->patient->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.modality') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->modality->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.procedure') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->procedure->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.radiologist') }}
                                    </th>
                                    <td>
                                        {{ $workOrder->radiologist->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.workOrder.fields.image') }}
                                    </th>
                                    <td>
                                        @foreach($workOrder->image as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.work-orders.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection