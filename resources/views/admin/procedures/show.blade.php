@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.procedure.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.procedures.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.procedure.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $procedure->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.procedure.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $procedure->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.procedure.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Procedure::STATUS_SELECT[$procedure->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.procedure.fields.modality') }}
                                    </th>
                                    <td>
                                        {{ $procedure->modality->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.procedure.fields.procedure_type') }}
                                    </th>
                                    <td>
                                        {{ $procedure->procedure_type->title ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.procedures.index') }}">
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
                        <a href="#procedure_macros" aria-controls="procedure_macros" role="tab" data-toggle="tab">
                            {{ trans('cruds.macro.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#procedure_work_orders" aria-controls="procedure_work_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.workOrder.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="procedure_macros">
                        @includeIf('admin.procedures.relationships.procedureMacros', ['macros' => $procedure->procedureMacros])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="procedure_work_orders">
                        @includeIf('admin.procedures.relationships.procedureWorkOrders', ['workOrders' => $procedure->procedureWorkOrders])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection