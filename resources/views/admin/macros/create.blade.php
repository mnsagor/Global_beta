@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.macro.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.macros.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.macro.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.macro.fields.title_helper') }}</span>
                        </div>
{{--                        select the modality--}}
                        <div class="form-group {{ $errors->has('modality') ? 'has-error' : '' }}">
                            <label class="required" for="modality_id">{{ trans('cruds.macro.fields.modality') }}</label>
                            <select class="form-control select2 dynamic" name="modality_id" id="modality_id" data-dependent="procedure_id" required>
                                @foreach($modalities as $id => $modality)
                                    <option value="{{ $id }}" {{ old('modality_id') == $id ? 'selected' : '' }}>{{ $modality }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('modality'))
                                <span class="help-block" role="alert">{{ $errors->first('modality') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.macro.fields.modality_helper') }}</span>
                        </div>

{{--                        select corresponding procedure--}}
                        <div class="form-group {{ $errors->has('procedure') ? 'has-error' : '' }}">
                            <label class="required" for="procedure_id">{{ trans('cruds.macro.fields.procedure') }}</label>
                            <select class="form-control select2" name="procedure_id" id="procedure_id" required>
{{--                                @foreach($procedures as $id => $procedure)--}}
{{--                                    <option value="{{ $id }}" {{ old('procedure_id') == $id ? 'selected' : '' }}>{{ $procedure }}</option>--}}
{{--                                @endforeach--}}
                                <option value="">Select Procedure</option>
                            </select>
                            @if($errors->has('procedure'))
                                <span class="help-block" role="alert">{{ $errors->first('procedure') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.macro.fields.procedure_helper') }}</span>
                        </div>


                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.macro.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Macro::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.macro.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
                            <label for="details">{{ trans('cruds.macro.fields.details') }}</label>
                            <textarea class="form-control ckeditor" name="details" id="details">{!! old('details') !!}</textarea>
                            @if($errors->has('details'))
                                <span class="help-block" role="alert">{{ $errors->first('details') }}</span>
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



        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {

        $('.dynamic').change(function () {
            if($(this).val() != '')
            {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('admin.macros.fetchProcedures') }}",
                    method:"POST",
                    data:{select:select, value:value, _token:_token, dependent:dependent},
                    success:function(result)
                    {
                        $('#'+dependent).html(result);
                    }

                })
            }
        });

        $('#modality_id').change(function(){
            $('#procedure_id').val('');
        });

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
