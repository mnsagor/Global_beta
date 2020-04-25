@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.hospital.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.hospitals.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.hospital.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.hospital.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Hospital::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('hospital_code') ? 'has-error' : '' }}">
                            <label for="hospital_code">{{ trans('cruds.hospital.fields.hospital_code') }}</label>
                            <input class="form-control" type="text" name="hospital_code" id="hospital_code" value="{{ old('hospital_code', '') }}">
                            @if($errors->has('hospital_code'))
                                <span class="help-block" role="alert">{{ $errors->first('hospital_code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.hospital_code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address">{{ trans('cruds.hospital.fields.address') }}</label>
                            <textarea class="form-control ckeditor" name="address" id="address">{!! old('address') !!}</textarea>
                            @if($errors->has('address'))
                                <span class="help-block" role="alert">{{ $errors->first('address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('manager_name') ? 'has-error' : '' }}">
                            <label for="manager_name">{{ trans('cruds.hospital.fields.manager_name') }}</label>
                            <input class="form-control" type="text" name="manager_name" id="manager_name" value="{{ old('manager_name', '') }}">
                            @if($errors->has('manager_name'))
                                <span class="help-block" role="alert">{{ $errors->first('manager_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.manager_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('manager_phone_number') ? 'has-error' : '' }}">
                            <label for="manager_phone_number">{{ trans('cruds.hospital.fields.manager_phone_number') }}</label>
                            <input class="form-control" type="text" name="manager_phone_number" id="manager_phone_number" value="{{ old('manager_phone_number', '') }}">
                            @if($errors->has('manager_phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('manager_phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.manager_phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('techonologist_name') ? 'has-error' : '' }}">
                            <label for="techonologist_name">{{ trans('cruds.hospital.fields.techonologist_name') }}</label>
                            <input class="form-control" type="text" name="techonologist_name" id="techonologist_name" value="{{ old('techonologist_name', '') }}">
                            @if($errors->has('techonologist_name'))
                                <span class="help-block" role="alert">{{ $errors->first('techonologist_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.techonologist_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('technologist_phone_number') ? 'has-error' : '' }}">
                            <label for="technologist_phone_number">{{ trans('cruds.hospital.fields.technologist_phone_number') }}</label>
                            <input class="form-control" type="text" name="technologist_phone_number" id="technologist_phone_number" value="{{ old('technologist_phone_number', '') }}">
                            @if($errors->has('technologist_phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('technologist_phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.technologist_phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('receptionist_name') ? 'has-error' : '' }}">
                            <label for="receptionist_name">{{ trans('cruds.hospital.fields.receptionist_name') }}</label>
                            <input class="form-control" type="text" name="receptionist_name" id="receptionist_name" value="{{ old('receptionist_name', '') }}">
                            @if($errors->has('receptionist_name'))
                                <span class="help-block" role="alert">{{ $errors->first('receptionist_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.receptionist_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('receptionist_phone_number') ? 'has-error' : '' }}">
                            <label for="receptionist_phone_number">{{ trans('cruds.hospital.fields.receptionist_phone_number') }}</label>
                            <input class="form-control" type="text" name="receptionist_phone_number" id="receptionist_phone_number" value="{{ old('receptionist_phone_number', '') }}">
                            @if($errors->has('receptionist_phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('receptionist_phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.receptionist_phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('route_title') ? 'has-error' : '' }}">
                            <label for="route_title">{{ trans('cruds.hospital.fields.route_title') }}</label>
                            <input class="form-control" type="text" name="route_title" id="route_title" value="{{ old('route_title', '') }}">
                            @if($errors->has('route_title'))
                                <span class="help-block" role="alert">{{ $errors->first('route_title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.route_title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('route_ae_title') ? 'has-error' : '' }}">
                            <label for="route_ae_title">{{ trans('cruds.hospital.fields.route_ae_title') }}</label>
                            <input class="form-control" type="text" name="route_ae_title" id="route_ae_title" value="{{ old('route_ae_title', '') }}">
                            @if($errors->has('route_ae_title'))
                                <span class="help-block" role="alert">{{ $errors->first('route_ae_title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.route_ae_title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('route_host_name') ? 'has-error' : '' }}">
                            <label for="route_host_name">{{ trans('cruds.hospital.fields.route_host_name') }}</label>
                            <input class="form-control" type="text" name="route_host_name" id="route_host_name" value="{{ old('route_host_name', '') }}">
                            @if($errors->has('route_host_name'))
                                <span class="help-block" role="alert">{{ $errors->first('route_host_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.route_host_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('route_port') ? 'has-error' : '' }}">
                            <label for="route_port">{{ trans('cruds.hospital.fields.route_port') }}</label>
                            <input class="form-control" type="text" name="route_port" id="route_port" value="{{ old('route_port', '') }}">
                            @if($errors->has('route_port'))
                                <span class="help-block" role="alert">{{ $errors->first('route_port') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.route_port_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pacs_destinaiton_ae_title') ? 'has-error' : '' }}">
                            <label for="pacs_destinaiton_ae_title">{{ trans('cruds.hospital.fields.pacs_destinaiton_ae_title') }}</label>
                            <input class="form-control" type="text" name="pacs_destinaiton_ae_title" id="pacs_destinaiton_ae_title" value="{{ old('pacs_destinaiton_ae_title', '') }}">
                            @if($errors->has('pacs_destinaiton_ae_title'))
                                <span class="help-block" role="alert">{{ $errors->first('pacs_destinaiton_ae_title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.pacs_destinaiton_ae_title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pacs_ae_title') ? 'has-error' : '' }}">
                            <label for="pacs_ae_title">{{ trans('cruds.hospital.fields.pacs_ae_title') }}</label>
                            <input class="form-control" type="text" name="pacs_ae_title" id="pacs_ae_title" value="{{ old('pacs_ae_title', '') }}">
                            @if($errors->has('pacs_ae_title'))
                                <span class="help-block" role="alert">{{ $errors->first('pacs_ae_title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.pacs_ae_title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pacs_host_name') ? 'has-error' : '' }}">
                            <label for="pacs_host_name">{{ trans('cruds.hospital.fields.pacs_host_name') }}</label>
                            <input class="form-control" type="text" name="pacs_host_name" id="pacs_host_name" value="{{ old('pacs_host_name', '') }}">
                            @if($errors->has('pacs_host_name'))
                                <span class="help-block" role="alert">{{ $errors->first('pacs_host_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.pacs_host_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pacs_port') ? 'has-error' : '' }}">
                            <label for="pacs_port">{{ trans('cruds.hospital.fields.pacs_port') }}</label>
                            <input class="form-control" type="text" name="pacs_port" id="pacs_port" value="{{ old('pacs_port', '') }}">
                            @if($errors->has('pacs_port'))
                                <span class="help-block" role="alert">{{ $errors->first('pacs_port') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.pacs_port_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('proprietor_name') ? 'has-error' : '' }}">
                            <label for="proprietor_name">{{ trans('cruds.hospital.fields.proprietor_name') }}</label>
                            <input class="form-control" type="text" name="proprietor_name" id="proprietor_name" value="{{ old('proprietor_name', '') }}">
                            @if($errors->has('proprietor_name'))
                                <span class="help-block" role="alert">{{ $errors->first('proprietor_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.proprietor_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('proprietor_phone_number') ? 'has-error' : '' }}">
                            <label for="proprietor_phone_number">{{ trans('cruds.hospital.fields.proprietor_phone_number') }}</label>
                            <input class="form-control" type="text" name="proprietor_phone_number" id="proprietor_phone_number" value="{{ old('proprietor_phone_number', '') }}">
                            @if($errors->has('proprietor_phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('proprietor_phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.proprietor_phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('chairman_name') ? 'has-error' : '' }}">
                            <label for="chairman_name">{{ trans('cruds.hospital.fields.chairman_name') }}</label>
                            <input class="form-control" type="text" name="chairman_name" id="chairman_name" value="{{ old('chairman_name', '') }}">
                            @if($errors->has('chairman_name'))
                                <span class="help-block" role="alert">{{ $errors->first('chairman_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.chairman_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('chairman_phone_number') ? 'has-error' : '' }}">
                            <label for="chairman_phone_number">{{ trans('cruds.hospital.fields.chairman_phone_number') }}</label>
                            <input class="form-control" type="text" name="chairman_phone_number" id="chairman_phone_number" value="{{ old('chairman_phone_number', '') }}">
                            @if($errors->has('chairman_phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('chairman_phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.chairman_phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('director_name') ? 'has-error' : '' }}">
                            <label for="director_name">{{ trans('cruds.hospital.fields.director_name') }}</label>
                            <input class="form-control" type="text" name="director_name" id="director_name" value="{{ old('director_name', '') }}">
                            @if($errors->has('director_name'))
                                <span class="help-block" role="alert">{{ $errors->first('director_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.director_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('director_phone_number') ? 'has-error' : '' }}">
                            <label for="director_phone_number">{{ trans('cruds.hospital.fields.director_phone_number') }}</label>
                            <input class="form-control" type="text" name="director_phone_number" id="director_phone_number" value="{{ old('director_phone_number', '') }}">
                            @if($errors->has('director_phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('director_phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.director_phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('accountant_name') ? 'has-error' : '' }}">
                            <label for="accountant_name">{{ trans('cruds.hospital.fields.accountant_name') }}</label>
                            <input class="form-control" type="text" name="accountant_name" id="accountant_name" value="{{ old('accountant_name', '') }}">
                            @if($errors->has('accountant_name'))
                                <span class="help-block" role="alert">{{ $errors->first('accountant_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.accountant_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('accountant_phone_number') ? 'has-error' : '' }}">
                            <label for="accountant_phone_number">{{ trans('cruds.hospital.fields.accountant_phone_number') }}</label>
                            <input class="form-control" type="text" name="accountant_phone_number" id="accountant_phone_number" value="{{ old('accountant_phone_number', '') }}">
                            @if($errors->has('accountant_phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('accountant_phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.accountant_phone_number_helper') }}</span>
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
                xhr.open('POST', '/admin/hospitals/ckmedia', true);
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
                data.append('crud_id', {{ $hospital->id ?? 0 }});
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