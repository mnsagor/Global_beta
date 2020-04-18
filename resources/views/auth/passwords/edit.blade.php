@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.change_password') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("profile.password.update") }}">
                        @csrf
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="required" for="password">New {{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control" type="password" name="password" id="password" required>
                            @if($errors->has('password'))
                                <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="password_confirmation">Repeat New {{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
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