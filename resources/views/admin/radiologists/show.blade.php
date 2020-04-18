@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.radiologist.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.radiologists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.id') }}
                        </th>
                        <td>
                            {{ $radiologist->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.name') }}
                        </th>
                        <td>
                            {{ $radiologist->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $radiologist->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.address') }}
                        </th>
                        <td>
                            {!! $radiologist->address !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.designation') }}
                        </th>
                        <td>
                            {{ $radiologist->designation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.hospital') }}
                        </th>
                        <td>
                            @foreach($radiologist->hospitals as $key => $hospital)
                                <span class="label label-info">{{ $hospital->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Radiologist::GENDER_SELECT[$radiologist->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.modality') }}
                        </th>
                        <td>
                            @foreach($radiologist->modalities as $key => $modality)
                                <span class="label label-info">{{ $modality->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.macro') }}
                        </th>
                        <td>
                            @foreach($radiologist->macros as $key => $macro)
                                <span class="label label-info">{{ $macro->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radiologist.fields.signature_image') }}
                        </th>
                        <td>
                            @if($radiologist->signature_image)
                                <a href="{{ $radiologist->signature_image->getUrl() }}" target="_blank">
                                    <img src="{{ $radiologist->signature_image->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.radiologists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#radiologist_work_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.workOrder.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="radiologist_work_orders">
            @includeIf('admin.radiologists.relationships.radiologistWorkOrders', ['workOrders' => $radiologist->radiologistWorkOrders])
        </div>
    </div>
</div>

@endsection