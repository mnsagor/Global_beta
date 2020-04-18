@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.transaction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transactions.update", [$transaction->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="project_id">{{ trans('cruds.transaction.fields.project') }}</label>
                <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}" name="project_id" id="project_id" required>
                    @foreach($projects as $id => $project)
                        <option value="{{ $id }}" {{ ($transaction->project ? $transaction->project->id : old('project_id')) == $id ? 'selected' : '' }}>{{ $project }}</option>
                    @endforeach
                </select>
                @if($errors->has('project'))
                    <span class="text-danger">{{ $errors->first('project') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.project_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transaction_type_id">{{ trans('cruds.transaction.fields.transaction_type') }}</label>
                <select class="form-control select2 {{ $errors->has('transaction_type') ? 'is-invalid' : '' }}" name="transaction_type_id" id="transaction_type_id" required>
                    @foreach($transaction_types as $id => $transaction_type)
                        <option value="{{ $id }}" {{ ($transaction->transaction_type ? $transaction->transaction_type->id : old('transaction_type_id')) == $id ? 'selected' : '' }}>{{ $transaction_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('transaction_type'))
                    <span class="text-danger">{{ $errors->first('transaction_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.transaction_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="income_source_id">{{ trans('cruds.transaction.fields.income_source') }}</label>
                <select class="form-control select2 {{ $errors->has('income_source') ? 'is-invalid' : '' }}" name="income_source_id" id="income_source_id" required>
                    @foreach($income_sources as $id => $income_source)
                        <option value="{{ $id }}" {{ ($transaction->income_source ? $transaction->income_source->id : old('income_source_id')) == $id ? 'selected' : '' }}>{{ $income_source }}</option>
                    @endforeach
                </select>
                @if($errors->has('income_source'))
                    <span class="text-danger">{{ $errors->first('income_source') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.income_source_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $transaction->amount) }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="currency_id">{{ trans('cruds.transaction.fields.currency') }}</label>
                <select class="form-control select2 {{ $errors->has('currency') ? 'is-invalid' : '' }}" name="currency_id" id="currency_id" required>
                    @foreach($currencies as $id => $currency)
                        <option value="{{ $id }}" {{ ($transaction->currency ? $transaction->currency->id : old('currency_id')) == $id ? 'selected' : '' }}>{{ $currency }}</option>
                    @endforeach
                </select>
                @if($errors->has('currency'))
                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transaction_date">{{ trans('cruds.transaction.fields.transaction_date') }}</label>
                <input class="form-control date {{ $errors->has('transaction_date') ? 'is-invalid' : '' }}" type="text" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date) }}" required>
                @if($errors->has('transaction_date'))
                    <span class="text-danger">{{ $errors->first('transaction_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.transaction_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.transaction.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $transaction->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.transaction.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $transaction->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
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



@endsection