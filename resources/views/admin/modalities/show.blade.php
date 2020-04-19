@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.modality.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.modalities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $modality->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $modality->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Modality::STATUS_SELECT[$modality->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.modality.fields.details') }}
                                    </th>
                                    <td>
                                        {!! $modality->details !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.modalities.index') }}">
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
                        <a href="#modality_procedures" aria-controls="modality_procedures" role="tab" data-toggle="tab">
                            {{ trans('cruds.procedure.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#modality_macros" aria-controls="modality_macros" role="tab" data-toggle="tab">
                            {{ trans('cruds.macro.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#modality_work_orders" aria-controls="modality_work_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.workOrder.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#modality_radiologists" aria-controls="modality_radiologists" role="tab" data-toggle="tab">
                            {{ trans('cruds.radiologist.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="modality_procedures">
                        @includeIf('admin.modalities.relationships.modalityProcedures', ['procedures' => $modality->modalityProcedures])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="modality_macros">
                        @includeIf('admin.modalities.relationships.modalityMacros', ['macros' => $modality->modalityMacros])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="modality_work_orders">
                        @includeIf('admin.modalities.relationships.modalityWorkOrders', ['workOrders' => $modality->modalityWorkOrders])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="modality_radiologists">
                        @includeIf('admin.modalities.relationships.modalityRadiologists', ['radiologists' => $modality->modalityRadiologists])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection