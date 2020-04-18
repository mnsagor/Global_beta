@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.note.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="project_id">{{ trans('cruds.note.fields.project') }}</label>
                <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}" name="project_id" id="project_id" required>
                    @foreach($projects as $id => $project)
                        <option value="{{ $id }}" {{ old('project_id') == $id ? 'selected' : '' }}>{{ $project }}</option>
                    @endforeach
                </select>
                @if($errors->has('project'))
                    <span class="text-danger">{{ $errors->first('project') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.project_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="note_text">{{ trans('cruds.note.fields.note_text') }}</label>
                <textarea class="form-control {{ $errors->has('note_text') ? 'is-invalid' : '' }}" name="note_text" id="note_text" required>{{ old('note_text') }}</textarea>
                @if($errors->has('note_text'))
                    <span class="text-danger">{{ $errors->first('note_text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.note.fields.note_text_helper') }}</span>
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