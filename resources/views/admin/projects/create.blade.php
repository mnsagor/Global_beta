@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.project.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.projects.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.project.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('client') ? 'has-error' : '' }}">
                            <label class="required" for="client_id">{{ trans('cruds.project.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id" required>
                                @foreach($clients as $id => $client)
                                    <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $client }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <span class="help-block" role="alert">{{ $errors->first('client') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.project.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label for="start_date">{{ trans('cruds.project.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                            @if($errors->has('start_date'))
                                <span class="help-block" role="alert">{{ $errors->first('start_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('budget') ? 'has-error' : '' }}">
                            <label for="budget">{{ trans('cruds.project.fields.budget') }}</label>
                            <input class="form-control" type="number" name="budget" id="budget" value="{{ old('budget', '') }}" step="0.01">
                            @if($errors->has('budget'))
                                <span class="help-block" role="alert">{{ $errors->first('budget') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.budget_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label for="status_id">{{ trans('cruds.project.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id">
                                @foreach($statuses as $id => $status)
                                    <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.status_helper') }}</span>
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