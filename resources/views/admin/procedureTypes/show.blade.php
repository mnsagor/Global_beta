@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.procedureType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.procedure-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.procedureType.fields.id') }}
                        </th>
                        <td>
                            {{ $procedureType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.procedureType.fields.title') }}
                        </th>
                        <td>
                            {{ $procedureType->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.procedure-types.index') }}">
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
            <a class="nav-link" href="#procedure_type_procedures" role="tab" data-toggle="tab">
                {{ trans('cruds.procedure.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="procedure_type_procedures">
            @includeIf('admin.procedureTypes.relationships.procedureTypeProcedures', ['procedures' => $procedureType->procedureTypeProcedures])
        </div>
    </div>
</div>

@endsection