@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.macro.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.macros.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.macro.fields.id') }}
                        </th>
                        <td>
                            {{ $macro->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.macro.fields.title') }}
                        </th>
                        <td>
                            {{ $macro->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.macro.fields.modality') }}
                        </th>
                        <td>
                            {{ $macro->modality->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.macro.fields.procedure') }}
                        </th>
                        <td>
                            {{ $macro->procedure->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.macro.fields.status') }}
                        </th>
                        <td>
                            {{ App\Macro::STATUS_SELECT[$macro->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.macro.fields.details') }}
                        </th>
                        <td>
                            {!! $macro->details !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.macros.index') }}">
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
            <a class="nav-link" href="#macro_radiologists" role="tab" data-toggle="tab">
                {{ trans('cruds.radiologist.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="macro_radiologists">
            @includeIf('admin.macros.relationships.macroRadiologists', ['radiologists' => $macro->macroRadiologists])
        </div>
    </div>
</div>

@endsection