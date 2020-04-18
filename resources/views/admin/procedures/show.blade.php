@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.procedure.title') }}
    </div>

    <div class="card-body">
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

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#procedure_macros" role="tab" data-toggle="tab">
                {{ trans('cruds.macro.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#procedure_work_orders" role="tab" data-toggle="tab">
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

@endsection