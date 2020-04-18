@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.radiologist.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.radiologists.update", [$radiologist->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.radiologist.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $radiologist->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.radiologist.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_number">{{ trans('cruds.radiologist.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $radiologist->phone_number) }}">
                @if($errors->has('phone_number'))
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.radiologist.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.radiologist.fields.address') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{!! old('address', $radiologist->address) !!}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.radiologist.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="designation">{{ trans('cruds.radiologist.fields.designation') }}</label>
                <input class="form-control {{ $errors->has('designation') ? 'is-invalid' : '' }}" type="text" name="designation" id="designation" value="{{ old('designation', $radiologist->designation) }}">
                @if($errors->has('designation'))
                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.radiologist.fields.designation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hospitals">{{ trans('cruds.radiologist.fields.hospital') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('hospitals') ? 'is-invalid' : '' }}" name="hospitals[]" id="hospitals" multiple>
                    @foreach($hospitals as $id => $hospital)
                        <option value="{{ $id }}" {{ (in_array($id, old('hospitals', [])) || $radiologist->hospitals->contains($id)) ? 'selected' : '' }}>{{ $hospital }}</option>
                    @endforeach
                </select>
                @if($errors->has('hospitals'))
                    <span class="text-danger">{{ $errors->first('hospitals') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.radiologist.fields.hospital_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.radiologist.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Radiologist::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', $radiologist->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.radiologist.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="modalities">{{ trans('cruds.radiologist.fields.modality') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('modalities') ? 'is-invalid' : '' }}" name="modalities[]" id="modalities" multiple>
                    @foreach($modalities as $id => $modality)
                        <option value="{{ $id }}" {{ (in_array($id, old('modalities', [])) || $radiologist->modalities->contains($id)) ? 'selected' : '' }}>{{ $modality }}</option>
                    @endforeach
                </select>
                @if($errors->has('modalities'))
                    <span class="text-danger">{{ $errors->first('modalities') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.radiologist.fields.modality_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="macros">{{ trans('cruds.radiologist.fields.macro') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('macros') ? 'is-invalid' : '' }}" name="macros[]" id="macros" multiple>
                    @foreach($macros as $id => $macro)
                        <option value="{{ $id }}" {{ (in_array($id, old('macros', [])) || $radiologist->macros->contains($id)) ? 'selected' : '' }}>{{ $macro }}</option>
                    @endforeach
                </select>
                @if($errors->has('macros'))
                    <span class="text-danger">{{ $errors->first('macros') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.radiologist.fields.macro_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="signature_image">{{ trans('cruds.radiologist.fields.signature_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('signature_image') ? 'is-invalid' : '' }}" id="signature_image-dropzone">
                </div>
                @if($errors->has('signature_image'))
                    <span class="text-danger">{{ $errors->first('signature_image') }}</span>
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