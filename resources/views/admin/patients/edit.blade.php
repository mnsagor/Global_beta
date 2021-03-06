@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.patient.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.patients.update", [$patient->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.patient.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.patient.fields.gender') }}</label>
                            @foreach(App\Patient::GENDER_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $patient->gender) === (string) $key ? 'checked' : '' }}>
                                    <label for="gender_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('gender'))
                                <span class="help-block" role="alert">{{ $errors->first('gender') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.gender_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('dof') ? 'has-error' : '' }}">
                            <label for="dof">{{ trans('cruds.patient.fields.dof') }}</label>
                            <input class="form-control date" type="text" name="dof" id="dof" value="{{ old('dof', $patient->dof) }}">
                            @if($errors->has('dof'))
                                <span class="help-block" role="alert">{{ $errors->first('dof') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.dof_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('cruds.patient.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $patient->email) }}">
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                            <label for="phone_number">{{ trans('cruds.patient.fields.phone_number') }}</label>
                            <input class="form-control" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $patient->phone_number) }}">
                            @if($errors->has('phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('nid') ? 'has-error' : '' }}">
                            <label for="nid">{{ trans('cruds.patient.fields.nid') }}</label>
                            <input class="form-control" type="text" name="nid" id="nid" value="{{ old('nid', $patient->nid) }}">
                            @if($errors->has('nid'))
                                <span class="help-block" role="alert">{{ $errors->first('nid') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.nid_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('clinical_history') ? 'has-error' : '' }}">
                            <label for="clinical_history">{{ trans('cruds.patient.fields.clinical_history') }}</label>
                            <textarea class="form-control ckeditor" name="clinical_history" id="clinical_history">{!! old('clinical_history', $patient->clinical_history) !!}</textarea>
                            @if($errors->has('clinical_history'))
                                <span class="help-block" role="alert">{{ $errors->first('clinical_history') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.clinical_history_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('surgical_history') ? 'has-error' : '' }}">
                            <label for="surgical_history">{{ trans('cruds.patient.fields.surgical_history') }}</label>
                            <textarea class="form-control ckeditor" name="surgical_history" id="surgical_history">{!! old('surgical_history', $patient->surgical_history) !!}</textarea>
                            @if($errors->has('surgical_history'))
                                <span class="help-block" role="alert">{{ $errors->first('surgical_history') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.surgical_history_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('lab_results') ? 'has-error' : '' }}">
                            <label for="lab_results">{{ trans('cruds.patient.fields.lab_results') }}</label>
                            <input class="form-control" type="text" name="lab_results" id="lab_results" value="{{ old('lab_results', $patient->lab_results) }}">
                            @if($errors->has('lab_results'))
                                <span class="help-block" role="alert">{{ $errors->first('lab_results') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.lab_results_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('deo_comments') ? 'has-error' : '' }}">
                            <label for="deo_comments">{{ trans('cruds.patient.fields.deo_comments') }}</label>
                            <textarea class="form-control ckeditor" name="deo_comments" id="deo_comments">{!! old('deo_comments', $patient->deo_comments) !!}</textarea>
                            @if($errors->has('deo_comments'))
                                <span class="help-block" role="alert">{{ $errors->first('deo_comments') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.deo_comments_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('clinical_diagnosis') ? 'has-error' : '' }}">
                            <label for="clinical_diagnosis">{{ trans('cruds.patient.fields.clinical_diagnosis') }}</label>
                            <textarea class="form-control ckeditor" name="clinical_diagnosis" id="clinical_diagnosis">{!! old('clinical_diagnosis', $patient->clinical_diagnosis) !!}</textarea>
                            @if($errors->has('clinical_diagnosis'))
                                <span class="help-block" role="alert">{{ $errors->first('clinical_diagnosis') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.clinical_diagnosis_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('files') ? 'has-error' : '' }}">
                            <label for="files">{{ trans('cruds.patient.fields.files') }}</label>
                            <div class="needsclick dropzone" id="files-dropzone">
                            </div>
                            @if($errors->has('files'))
                                <span class="help-block" role="alert">{{ $errors->first('files') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.files_helper') }}</span>
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
                xhr.open('POST', '/admin/patients/ckmedia', true);
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
                data.append('crud_id', {{ $patient->id ?? 0 }});
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
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.patients.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($patient) && $patient->files)
          var files =
            {!! json_encode($patient->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
            }
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