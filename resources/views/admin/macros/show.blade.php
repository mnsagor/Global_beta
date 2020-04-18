@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.macro.title') }}
                </div>
                <div class="panel-body">
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

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#macro_radiologists" aria-controls="macro_radiologists" role="tab" data-toggle="tab">
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

        </div>
    </div>
</div>
@endsection