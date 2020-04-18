@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.currency.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.currencies.update", [$currency->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.currency.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $currency->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                            <label class="required" for="code">{{ trans('cruds.currency.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', $currency->code) }}" required>
                            @if($errors->has('code'))
                                <span class="help-block" role="alert">{{ $errors->first('code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('main_currency') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="main_currency" value="0">
                                <input type="checkbox" name="main_currency" id="main_currency" value="1" {{ $currency->main_currency || old('main_currency', 0) === 1 ? 'checked' : '' }}>
                                <label for="main_currency" style="font-weight: 400">{{ trans('cruds.currency.fields.main_currency') }}</label>
                            </div>
                            @if($errors->has('main_currency'))
                                <span class="help-block" role="alert">{{ $errors->first('main_currency') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.currency.fields.main_currency_helper') }}</span>
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