@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.incomeSource.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.income-sources.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.incomeSource.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.incomeSource.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('fee_percent') ? 'has-error' : '' }}">
                            <label for="fee_percent">{{ trans('cruds.incomeSource.fields.fee_percent') }}</label>
                            <input class="form-control" type="number" name="fee_percent" id="fee_percent" value="{{ old('fee_percent', '') }}" step="0.01">
                            @if($errors->has('fee_percent'))
                                <span class="help-block" role="alert">{{ $errors->first('fee_percent') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.incomeSource.fields.fee_percent_helper') }}</span>
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