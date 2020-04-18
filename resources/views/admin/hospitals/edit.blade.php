@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hospital.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hospitals.update", [$hospital->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.hospital.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $hospital->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hospital_code">{{ trans('cruds.hospital.fields.hospital_code') }}</label>
                <input class="form-control {{ $errors->has('hospital_code') ? 'is-invalid' : '' }}" type="text" name="hospital_code" id="hospital_code" value="{{ old('hospital_code', $hospital->hospital_code) }}">
                @if($errors->has('hospital_code'))
                    <span class="text-danger">{{ $errors->first('hospital_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.hospital_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.hospital.fields.address') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{!! old('address', $hospital->address) !!}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manager_name">{{ trans('cruds.hospital.fields.manager_name') }}</label>
                <input class="form-control {{ $errors->has('manager_name') ? 'is-invalid' : '' }}" type="text" name="manager_name" id="manager_name" value="{{ old('manager_name', $hospital->manager_name) }}">
                @if($errors->has('manager_name'))
                    <span class="text-danger">{{ $errors->first('manager_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.manager_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manager_phone_number">{{ trans('cruds.hospital.fields.manager_phone_number') }}</label>
                <input class="form-control {{ $errors->has('manager_phone_number') ? 'is-invalid' : '' }}" type="text" name="manager_phone_number" id="manager_phone_number" value="{{ old('manager_phone_number', $hospital->manager_phone_number) }}">
                @if($errors->has('manager_phone_number'))
                    <span class="text-danger">{{ $errors->first('manager_phone_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.manager_phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="techonologist_name">{{ trans('cruds.hospital.fields.techonologist_name') }}</label>
                <input class="form-control {{ $errors->has('techonologist_name') ? 'is-invalid' : '' }}" type="text" name="techonologist_name" id="techonologist_name" value="{{ old('techonologist_name', $hospital->techonologist_name) }}">
                @if($errors->has('techonologist_name'))
                    <span class="text-danger">{{ $errors->first('techonologist_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.techonologist_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="technologist_phone_number">{{ trans('cruds.hospital.fields.technologist_phone_number') }}</label>
                <input class="form-control {{ $errors->has('technologist_phone_number') ? 'is-invalid' : '' }}" type="text" name="technologist_phone_number" id="technologist_phone_number" value="{{ old('technologist_phone_number', $hospital->technologist_phone_number) }}">
                @if($errors->has('technologist_phone_number'))
                    <span class="text-danger">{{ $errors->first('technologist_phone_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.technologist_phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receptionist_name">{{ trans('cruds.hospital.fields.receptionist_name') }}</label>
                <input class="form-control {{ $errors->has('receptionist_name') ? 'is-invalid' : '' }}" type="text" name="receptionist_name" id="receptionist_name" value="{{ old('receptionist_name', $hospital->receptionist_name) }}">
                @if($errors->has('receptionist_name'))
                    <span class="text-danger">{{ $errors->first('receptionist_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.receptionist_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receptionist_phone_number">{{ trans('cruds.hospital.fields.receptionist_phone_number') }}</label>
                <input class="form-control {{ $errors->has('receptionist_phone_number') ? 'is-invalid' : '' }}" type="text" name="receptionist_phone_number" id="receptionist_phone_number" value="{{ old('receptionist_phone_number', $hospital->receptionist_phone_number) }}">
                @if($errors->has('receptionist_phone_number'))
                    <span class="text-danger">{{ $errors->first('receptionist_phone_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.receptionist_phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="route_title">{{ trans('cruds.hospital.fields.route_title') }}</label>
                <input class="form-control {{ $errors->has('route_title') ? 'is-invalid' : '' }}" type="text" name="route_title" id="route_title" value="{{ old('route_title', $hospital->route_title) }}">
                @if($errors->has('route_title'))
                    <span class="text-danger">{{ $errors->first('route_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.route_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="route_ae_title">{{ trans('cruds.hospital.fields.route_ae_title') }}</label>
                <input class="form-control {{ $errors->has('route_ae_title') ? 'is-invalid' : '' }}" type="text" name="route_ae_title" id="route_ae_title" value="{{ old('route_ae_title', $hospital->route_ae_title) }}">
                @if($errors->has('route_ae_title'))
                    <span class="text-danger">{{ $errors->first('route_ae_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.route_ae_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="route_host_name">{{ trans('cruds.hospital.fields.route_host_name') }}</label>
                <input class="form-control {{ $errors->has('route_host_name') ? 'is-invalid' : '' }}" type="text" name="route_host_name" id="route_host_name" value="{{ old('route_host_name', $hospital->route_host_name) }}">
                @if($errors->has('route_host_name'))
                    <span class="text-danger">{{ $errors->first('route_host_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.route_host_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="route_port">{{ trans('cruds.hospital.fields.route_port') }}</label>
                <input class="form-control {{ $errors->has('route_port') ? 'is-invalid' : '' }}" type="text" name="route_port" id="route_port" value="{{ old('route_port', $hospital->route_port) }}">
                @if($errors->has('route_port'))
                    <span class="text-danger">{{ $errors->first('route_port') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.route_port_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pacs_destinaiton_ae_title">{{ trans('cruds.hospital.fields.pacs_destinaiton_ae_title') }}</label>
                <input class="form-control {{ $errors->has('pacs_destinaiton_ae_title') ? 'is-invalid' : '' }}" type="text" name="pacs_destinaiton_ae_title" id="pacs_destinaiton_ae_title" value="{{ old('pacs_destinaiton_ae_title', $hospital->pacs_destinaiton_ae_title) }}">
                @if($errors->has('pacs_destinaiton_ae_title'))
                    <span class="text-danger">{{ $errors->first('pacs_destinaiton_ae_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.pacs_destinaiton_ae_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pacs_ae_title">{{ trans('cruds.hospital.fields.pacs_ae_title') }}</label>
                <input class="form-control {{ $errors->has('pacs_ae_title') ? 'is-invalid' : '' }}" type="text" name="pacs_ae_title" id="pacs_ae_title" value="{{ old('pacs_ae_title', $hospital->pacs_ae_title) }}">
                @if($errors->has('pacs_ae_title'))
                    <span class="text-danger">{{ $errors->first('pacs_ae_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.pacs_ae_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pacs_host_name">{{ trans('cruds.hospital.fields.pacs_host_name') }}</label>
                <input class="form-control {{ $errors->has('pacs_host_name') ? 'is-invalid' : '' }}" type="text" name="pacs_host_name" id="pacs_host_name" value="{{ old('pacs_host_name', $hospital->pacs_host_name) }}">
                @if($errors->has('pacs_host_name'))
                    <span class="text-danger">{{ $errors->first('pacs_host_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.pacs_host_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pacs_port">{{ trans('cruds.hospital.fields.pacs_port') }}</label>
                <input class="form-control {{ $errors->has('pacs_port') ? 'is-invalid' : '' }}" type="text" name="pacs_port" id="pacs_port" value="{{ old('pacs_port', $hospital->pacs_port) }}">
                @if($errors->has('pacs_port'))
                    <span class="text-danger">{{ $errors->first('pacs_port') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hospital.fields.pacs_port_helper') }}</span>
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