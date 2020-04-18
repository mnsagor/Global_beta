@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.income.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.incomes.update", [$income->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('income_category') ? 'has-error' : '' }}">
                            <label for="income_category_id">{{ trans('cruds.income.fields.income_category') }}</label>
                            <select class="form-control select2" name="income_category_id" id="income_category_id">
                                @foreach($income_categories as $id => $income_category)
                                    <option value="{{ $id }}" {{ ($income->income_category ? $income->income_category->id : old('income_category_id')) == $id ? 'selected' : '' }}>{{ $income_category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('income_category'))
                                <span class="help-block" role="alert">{{ $errors->first('income_category') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.income_category_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('entry_date') ? 'has-error' : '' }}">
                            <label class="required" for="entry_date">{{ trans('cruds.income.fields.entry_date') }}</label>
                            <input class="form-control date" type="text" name="entry_date" id="entry_date" value="{{ old('entry_date', $income->entry_date) }}" required>
                            @if($errors->has('entry_date'))
                                <span class="help-block" role="alert">{{ $errors->first('entry_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.entry_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                            <label class="required" for="amount">{{ trans('cruds.income.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $income->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <span class="help-block" role="alert">{{ $errors->first('amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.income.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $income->description) }}">
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.income.fields.description_helper') }}</span>
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