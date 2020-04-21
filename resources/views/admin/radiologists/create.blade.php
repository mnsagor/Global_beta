@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.radiologist.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.radiologists.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.radiologist.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                            <label class="required" for="roles">{{ trans('cruds.radiologist.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $roles }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <span class="help-block" role="alert">{{ $errors->first('roles') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.radiologist.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Radiologist::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                            <label for="phone_number">{{ trans('cruds.radiologist.fields.phone_number') }}</label>
                            <input class="form-control" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}">
                            @if($errors->has('phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address">{{ trans('cruds.radiologist.fields.address') }}</label>
                            <textarea class="form-control ckeditor" name="address" id="address">{!! old('address') !!}</textarea>
                            @if($errors->has('address'))
                                <span class="help-block" role="alert">{{ $errors->first('address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('designation') ? 'has-error' : '' }}">
                            <label for="designation">{{ trans('cruds.radiologist.fields.designation') }}</label>
                            <input class="form-control" type="text" name="designation" id="designation" value="{{ old('designation', 'Radiologist') }}">
                            @if($errors->has('designation'))
                                <span class="help-block" role="alert">{{ $errors->first('designation') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.designation_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('hospitals') ? 'has-error' : '' }}">
                            <label for="hospitals">{{ trans('cruds.radiologist.fields.hospital') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="hospitals[]" id="hospitals" multiple>
                                @foreach($hospitals as $id => $hospital)
                                    <option value="{{ $id }}" {{ in_array($id, old('hospitals', [])) ? 'selected' : '' }}>{{ $hospital }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('hospitals'))
                                <span class="help-block" role="alert">{{ $errors->first('hospitals') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.hospital_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.radiologist.fields.gender') }}</label>
                            <select class="form-control" name="gender" id="gender" required>
                                <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Radiologist::GENDER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('gender', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gender'))
                                <span class="help-block" role="alert">{{ $errors->first('gender') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.gender_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('modalities') ? 'has-error' : '' }}">
                            <label for="modalities">{{ trans('cruds.radiologist.fields.modality') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="modalities[]" id="modalities" multiple>
                                @foreach($modalities as $id => $modality)
                                    <option value="{{ $id }}" {{ in_array($id, old('modalities', [])) ? 'selected' : '' }}>{{ $modality }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('modalities'))
                                <span class="help-block" role="alert">{{ $errors->first('modalities') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.modality_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('macros') ? 'has-error' : '' }}">
                            <label for="macros">{{ trans('cruds.radiologist.fields.macro') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="macros[]" id="macros" multiple>
                                @foreach($macros as $id => $macro)
                                    <option value="{{ $id }}" {{ in_array($id, old('macros', [])) ? 'selected' : '' }}>{{ $macro }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('macros'))
                                <span class="help-block" role="alert">{{ $errors->first('macros') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.macro_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('signature_image') ? 'has-error' : '' }}">
                            <label class="required" for="signature_image">{{ trans('cruds.radiologist.fields.signature_image') }}</label>
                            <div class="needsclick dropzone" id="signature_image-dropzone">
                            </div>
                            @if($errors->has('signature_image'))
                                <span class="help-block" role="alert">{{ $errors->first('signature_image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.radiologist.fields.signature_image_helper') }}</span>
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
                xhr.open('POST', '/admin/radiologists/ckmedia', true);
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
                data.append('crud_id', {{ $radiologist->id ?? 0 }});
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

<script>
    Dropzone.options.signatureImageDropzone = {
    url: '{{ route('admin.radiologists.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="signature_image"]').remove()
      $('form').append('<input type="hidden" name="signature_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="signature_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($radiologist) && $radiologist->signature_image)
      var file = {!! json_encode($radiologist->signature_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $radiologist->signature_image->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="signature_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection