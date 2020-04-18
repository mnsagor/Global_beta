@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.procedure.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.procedures.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.procedure.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.procedure.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.procedure.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Procedure::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.procedure.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('modality') ? 'has-error' : '' }}">
                            <label class="required" for="modality_id">{{ trans('cruds.procedure.fields.modality') }}</label>
                            <select class="form-control select2" name="modality_id" id="modality_id" required>
                                @foreach($modalities as $id => $modality)
                                    <option value="{{ $id }}" {{ old('modality_id') == $id ? 'selected' : '' }}>{{ $modality }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('modality'))
                                <span class="help-block" role="alert">{{ $errors->first('modality') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.procedure.fields.modality_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('procedure_type') ? 'has-error' : '' }}">
                            <label class="required" for="procedure_type_id">{{ trans('cruds.procedure.fields.procedure_type') }}</label>
                            <select class="form-control select2" name="procedure_type_id" id="procedure_type_id" required>
                                @foreach($procedure_types as $id => $procedure_type)
                                    <option value="{{ $id }}" {{ old('procedure_type_id') == $id ? 'selected' : '' }}>{{ $procedure_type }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('procedure_type'))
                                <span class="help-block" role="alert">{{ $errors->first('procedure_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.procedure.fields.procedure_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection