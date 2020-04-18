@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.doctor.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.doctors.update", [$doctor->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.doctor.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $doctor->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('designation') ? 'has-error' : '' }}">
                            <label for="designation">{{ trans('cruds.doctor.fields.designation') }}</label>
                            <input class="form-control" type="text" name="designation" id="designation" value="{{ old('designation', $doctor->designation) }}">
                            @if($errors->has('designation'))
                                <span class="help-block" role="alert">{{ $errors->first('designation') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.designation_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('specilities') ? 'has-error' : '' }}">
                            <label for="specilities">{{ trans('cruds.doctor.fields.specilities') }}</label>
                            <input class="form-control" type="text" name="specilities" id="specilities" value="{{ old('specilities', $doctor->specilities) }}">
                            @if($errors->has('specilities'))
                                <span class="help-block" role="alert">{{ $errors->first('specilities') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.specilities_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('department') ? 'has-error' : '' }}">
                            <label for="department">{{ trans('cruds.doctor.fields.department') }}</label>
                            <input class="form-control" type="text" name="department" id="department" value="{{ old('department', $doctor->department) }}">
                            @if($errors->has('department'))
                                <span class="help-block" role="alert">{{ $errors->first('department') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.department_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('nid') ? 'has-error' : '' }}">
                            <label for="nid">{{ trans('cruds.doctor.fields.nid') }}</label>
                            <input class="form-control" type="text" name="nid" id="nid" value="{{ old('nid', $doctor->nid) }}">
                            @if($errors->has('nid'))
                                <span class="help-block" role="alert">{{ $errors->first('nid') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.nid_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.doctor.fields.gender') }}</label>
                            @foreach(App\Doctor::GENDER_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $doctor->gender) === (string) $key ? 'checked' : '' }}>
                                    <label for="gender_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('gender'))
                                <span class="help-block" role="alert">{{ $errors->first('gender') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.gender_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                            <label class="required" for="phone_number">{{ trans('cruds.doctor.fields.phone_number') }}</label>
                            <input class="form-control" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $doctor->phone_number) }}" required>
                            @if($errors->has('phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('cruds.doctor.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $doctor->email) }}">
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.doctor.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Doctor::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $doctor->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address">{{ trans('cruds.doctor.fields.address') }}</label>
                            <textarea class="form-control ckeditor" name="address" id="address">{!! old('address', $doctor->address) !!}</textarea>
                            @if($errors->has('address'))
                                <span class="help-block" role="alert">{{ $errors->first('address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('special_achievement') ? 'has-error' : '' }}">
                            <label for="special_achievement">{{ trans('cruds.doctor.fields.special_achievement') }}</label>
                            <textarea class="form-control ckeditor" name="special_achievement" id="special_achievement">{!! old('special_achievement', $doctor->special_achievement) !!}</textarea>
                            @if($errors->has('special_achievement'))
                                <span class="help-block" role="alert">{{ $errors->first('special_achievement') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.special_achievement_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('history') ? 'has-error' : '' }}">
                            <label for="history">{{ trans('cruds.doctor.fields.history') }}</label>
                            <textarea class="form-control ckeditor" name="history" id="history">{!! old('history', $doctor->history) !!}</textarea>
                            @if($errors->has('history'))
                                <span class="help-block" role="alert">{{ $errors->first('history') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.history_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/doctors/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', {{ $doctor->id ?? 0 }});
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection