@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.faqQuestion.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.faq-questions.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label class="required" for="category_id">{{ trans('cruds.faqQuestion.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <span class="help-block" role="alert">{{ $errors->first('category') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.faqQuestion.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                            <label class="required" for="question">{{ trans('cruds.faqQuestion.fields.question') }}</label>
                            <textarea class="form-control" name="question" id="question" required>{{ old('question') }}</textarea>
                            @if($errors->has('question'))
                                <span class="help-block" role="alert">{{ $errors->first('question') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.faqQuestion.fields.question_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
                            <label class="required" for="answer">{{ trans('cruds.faqQuestion.fields.answer') }}</label>
                            <textarea class="form-control" name="answer" id="answer" required>{{ old('answer') }}</textarea>
                            @if($errors->has('answer'))
                                <span class="help-block" role="alert">{{ $errors->first('answer') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.faqQuestion.fields.answer_helper') }}</span>
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