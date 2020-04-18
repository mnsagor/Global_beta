@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.procedure.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.procedures.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.procedure.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.procedure.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.procedure.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Procedure::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.procedure.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="modality_id">{{ trans('cruds.procedure.fields.modality') }}</label>
                <select class="form-control select2 {{ $errors->has('modality') ? 'is-invalid' : '' }}" name="modality_id" id="modality_id" required>
                    @foreach($modalities as $id => $modality)
                        <option value="{{ $id }}" {{ old('modality_id') == $id ? 'selected' : '' }}>{{ $modality }}</option>
                    @endforeach
                </select>
                @if($errors->has('modality'))
                    <span class="text-danger">{{ $errors->first('modality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.procedure.fields.modality_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="procedure_type_id">{{ trans('cruds.procedure.fields.procedure_type') }}</label>
                <select class="form-control select2 {{ $errors->has('procedure_type') ? 'is-invalid' : '' }}" name="procedure_type_id" id="procedure_type_id" required>
                    @foreach($procedure_types as $id => $procedure_type)
                        <option value="{{ $id }}" {{ old('procedure_type_id') == $id ? 'selected' : '' }}>{{ $procedure_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('procedure_type'))
                    <span class="text-danger">{{ $errors->first('procedure_type') }}</span>
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



@endsection