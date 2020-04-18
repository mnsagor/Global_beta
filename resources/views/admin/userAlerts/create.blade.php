@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.userAlert.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.user-alerts.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('alert_text') ? 'has-error' : '' }}">
                            <label class="required" for="alert_text">{{ trans('cruds.userAlert.fields.alert_text') }}</label>
                            <input class="form-control" type="text" name="alert_text" id="alert_text" value="{{ old('alert_text', '') }}" required>
                            @if($errors->has('alert_text'))
                                <span class="help-block" role="alert">{{ $errors->first('alert_text') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.userAlert.fields.alert_text_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('alert_link') ? 'has-error' : '' }}">
                            <label for="alert_link">{{ trans('cruds.userAlert.fields.alert_link') }}</label>
                            <input class="form-control" type="text" name="alert_link" id="alert_link" value="{{ old('alert_link', '') }}">
                            @if($errors->has('alert_link'))
                                <span class="help-block" role="alert">{{ $errors->first('alert_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.userAlert.fields.alert_link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('users') ? 'has-error' : '' }}">
                            <label for="users">{{ trans('cruds.userAlert.fields.user') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="users[]" id="users" multiple>
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}" {{ in_array($id, old('users', [])) ? 'selected' : '' }}>{{ $user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('users'))
                                <span class="help-block" role="alert">{{ $errors->first('users') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.userAlert.fields.user_helper') }}</span>
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