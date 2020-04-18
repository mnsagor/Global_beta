@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.contactContact.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.contact-contacts.update", [$contactContact->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                            <label class="required" for="company_id">{{ trans('cruds.contactContact.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id" required>
                                @foreach($companies as $id => $company)
                                    <option value="{{ $id }}" {{ ($contactContact->company ? $contactContact->company->id : old('company_id')) == $id ? 'selected' : '' }}>{{ $company }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <span class="help-block" role="alert">{{ $errors->first('company') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_first_name') ? 'has-error' : '' }}">
                            <label for="contact_first_name">{{ trans('cruds.contactContact.fields.contact_first_name') }}</label>
                            <input class="form-control" type="text" name="contact_first_name" id="contact_first_name" value="{{ old('contact_first_name', $contactContact->contact_first_name) }}">
                            @if($errors->has('contact_first_name'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_first_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_first_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_last_name') ? 'has-error' : '' }}">
                            <label for="contact_last_name">{{ trans('cruds.contactContact.fields.contact_last_name') }}</label>
                            <input class="form-control" type="text" name="contact_last_name" id="contact_last_name" value="{{ old('contact_last_name', $contactContact->contact_last_name) }}">
                            @if($errors->has('contact_last_name'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_last_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_last_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_phone_1') ? 'has-error' : '' }}">
                            <label for="contact_phone_1">{{ trans('cruds.contactContact.fields.contact_phone_1') }}</label>
                            <input class="form-control" type="text" name="contact_phone_1" id="contact_phone_1" value="{{ old('contact_phone_1', $contactContact->contact_phone_1) }}">
                            @if($errors->has('contact_phone_1'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_phone_1') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_phone_1_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_phone_2') ? 'has-error' : '' }}">
                            <label for="contact_phone_2">{{ trans('cruds.contactContact.fields.contact_phone_2') }}</label>
                            <input class="form-control" type="text" name="contact_phone_2" id="contact_phone_2" value="{{ old('contact_phone_2', $contactContact->contact_phone_2) }}">
                            @if($errors->has('contact_phone_2'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_phone_2') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_phone_2_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_email') ? 'has-error' : '' }}">
                            <label for="contact_email">{{ trans('cruds.contactContact.fields.contact_email') }}</label>
                            <input class="form-control" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email', $contactContact->contact_email) }}">
                            @if($errors->has('contact_email'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_skype') ? 'has-error' : '' }}">
                            <label for="contact_skype">{{ trans('cruds.contactContact.fields.contact_skype') }}</label>
                            <input class="form-control" type="text" name="contact_skype" id="contact_skype" value="{{ old('contact_skype', $contactContact->contact_skype) }}">
                            @if($errors->has('contact_skype'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_skype') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_skype_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('contact_address') ? 'has-error' : '' }}">
                            <label for="contact_address">{{ trans('cruds.contactContact.fields.contact_address') }}</label>
                            <input class="form-control" type="text" name="contact_address" id="contact_address" value="{{ old('contact_address', $contactContact->contact_address) }}">
                            @if($errors->has('contact_address'))
                                <span class="help-block" role="alert">{{ $errors->first('contact_address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_address_helper') }}</span>
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