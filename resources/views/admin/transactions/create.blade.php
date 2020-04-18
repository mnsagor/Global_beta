@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.transaction.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.transactions.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('project') ? 'has-error' : '' }}">
                            <label class="required" for="project_id">{{ trans('cruds.transaction.fields.project') }}</label>
                            <select class="form-control select2" name="project_id" id="project_id" required>
                                @foreach($projects as $id => $project)
                                    <option value="{{ $id }}" {{ old('project_id') == $id ? 'selected' : '' }}>{{ $project }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project'))
                                <span class="help-block" role="alert">{{ $errors->first('project') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.project_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('transaction_type') ? 'has-error' : '' }}">
                            <label class="required" for="transaction_type_id">{{ trans('cruds.transaction.fields.transaction_type') }}</label>
                            <select class="form-control select2" name="transaction_type_id" id="transaction_type_id" required>
                                @foreach($transaction_types as $id => $transaction_type)
                                    <option value="{{ $id }}" {{ old('transaction_type_id') == $id ? 'selected' : '' }}>{{ $transaction_type }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('transaction_type'))
                                <span class="help-block" role="alert">{{ $errors->first('transaction_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.transaction_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('income_source') ? 'has-error' : '' }}">
                            <label class="required" for="income_source_id">{{ trans('cruds.transaction.fields.income_source') }}</label>
                            <select class="form-control select2" name="income_source_id" id="income_source_id" required>
                                @foreach($income_sources as $id => $income_source)
                                    <option value="{{ $id }}" {{ old('income_source_id') == $id ? 'selected' : '' }}>{{ $income_source }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('income_source'))
                                <span class="help-block" role="alert">{{ $errors->first('income_source') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.income_source_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                            <label class="required" for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <span class="help-block" role="alert">{{ $errors->first('amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('currency') ? 'has-error' : '' }}">
                            <label class="required" for="currency_id">{{ trans('cruds.transaction.fields.currency') }}</label>
                            <select class="form-control select2" name="currency_id" id="currency_id" required>
                                @foreach($currencies as $id => $currency)
                                    <option value="{{ $id }}" {{ old('currency_id') == $id ? 'selected' : '' }}>{{ $currency }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('currency'))
                                <span class="help-block" role="alert">{{ $errors->first('currency') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('transaction_date') ? 'has-error' : '' }}">
                            <label class="required" for="transaction_date">{{ trans('cruds.transaction.fields.transaction_date') }}</label>
                            <input class="form-control date" type="text" name="transaction_date" id="transaction_date" value="{{ old('transaction_date') }}" required>
                            @if($errors->has('transaction_date'))
                                <span class="help-block" role="alert">{{ $errors->first('transaction_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.transaction_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.transaction.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.transaction.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.description_helper') }}</span>
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