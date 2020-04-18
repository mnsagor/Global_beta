@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.macro.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.macros.update", [$macro->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.macro.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $macro->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.macro.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="modality_id">{{ trans('cruds.macro.fields.modality') }}</label>
                <select class="form-control select2 {{ $errors->has('modality') ? 'is-invalid' : '' }}" name="modality_id" id="modality_id" required>
                    @foreach($modalities as $id => $modality)
                        <option value="{{ $id }}" {{ ($macro->modality ? $macro->modality->id : old('modality_id')) == $id ? 'selected' : '' }}>{{ $modality }}</option>
                    @endforeach
                </select>
                @if($errors->has('modality'))
                    <span class="text-danger">{{ $errors->first('modality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.macro.fields.modality_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="procedure_id">{{ trans('cruds.macro.fields.procedure') }}</label>
                <select class="form-control select2 {{ $errors->has('procedure') ? 'is-invalid' : '' }}" name="procedure_id" id="procedure_id" required>
                    @foreach($procedures as $id => $procedure)
                        <option value="{{ $id }}" {{ ($macro->procedure ? $macro->procedure->id : old('procedure_id')) == $id ? 'selected' : '' }}>{{ $procedure }}</option>
                    @endforeach
                </select>
                @if($errors->has('procedure'))
                    <span class="text-danger">{{ $errors->first('procedure') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.macro.fields.procedure_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.macro.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Macro::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $macro->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.macro.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="details">{{ trans('cruds.macro.fields.details') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('details') ? 'is-invalid' : '' }}" name="details" id="details">{!! old('details', $macro->details) !!}</textarea>
                @if($errors->has('details'))
                    <span class="text-danger">{{ $errors->first('details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.macro.fields.details_helper') }}</span>
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
                xhr.open('POST', '/admin/macros/ckmedia', true);
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
                data.append('crud_id', {{ $macro->id ?? 0 }});
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