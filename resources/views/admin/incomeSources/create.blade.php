@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.incomeSource.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.income-sources.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.incomeSource.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incomeSource.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fee_percent">{{ trans('cruds.incomeSource.fields.fee_percent') }}</label>
                <input class="form-control {{ $errors->has('fee_percent') ? 'is-invalid' : '' }}" type="number" name="fee_percent" id="fee_percent" value="{{ old('fee_percent', '') }}" step="0.01">
                @if($errors->has('fee_percent'))
                    <span class="text-danger">{{ $errors->first('fee_percent') }}</span>
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



@endsection