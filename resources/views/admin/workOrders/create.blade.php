@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.workOrder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.work-orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="registration_number">{{ trans('cruds.workOrder.fields.registration_number') }}</label>
                <input class="form-control {{ $errors->has('registration_number') ? 'is-invalid' : '' }}" type="text" name="registration_number" id="registration_number" value="{{ old('registration_number', '') }}" required>
                @if($errors->has('registration_number'))
                    <span class="text-danger">{{ $errors->first('registration_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.registration_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="work_order_status_id">{{ trans('cruds.workOrder.fields.work_order_status') }}</label>
                <select class="form-control select2 {{ $errors->has('work_order_status') ? 'is-invalid' : '' }}" name="work_order_status_id" id="work_order_status_id" required>
                    @foreach($work_order_statuses as $id => $work_order_status)
                        <option value="{{ $id }}" {{ old('work_order_status_id') == $id ? 'selected' : '' }}>{{ $work_order_status }}</option>
                    @endforeach
                </select>
                @if($errors->has('work_order_status'))
                    <span class="text-danger">{{ $errors->first('work_order_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.work_order_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="uploaded_by_id">{{ trans('cruds.workOrder.fields.uploaded_by') }}</label>
                <select class="form-control select2 {{ $errors->has('uploaded_by') ? 'is-invalid' : '' }}" name="uploaded_by_id" id="uploaded_by_id" required>
                    @foreach($uploaded_bies as $id => $uploaded_by)
                        <option value="{{ $id }}" {{ old('uploaded_by_id') == $id ? 'selected' : '' }}>{{ $uploaded_by }}</option>
                    @endforeach
                </select>
                @if($errors->has('uploaded_by'))
                    <span class="text-danger">{{ $errors->first('uploaded_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.uploaded_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data">{{ trans('cruds.workOrder.fields.data') }}</label>
                <input class="form-control datetime {{ $errors->has('data') ? 'is-invalid' : '' }}" type="text" name="data" id="data" value="{{ old('data') }}" required>
                @if($errors->has('data'))
                    <span class="text-danger">{{ $errors->first('data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.data_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hospital_id">{{ trans('cruds.workOrder.fields.hospital') }}</label>
                <select class="form-control select2 {{ $errors->has('hospital') ? 'is-invalid' : '' }}" name="hospital_id" id="hospital_id" required>
                    @foreach($hospitals as $id => $hospital)
                        <option value="{{ $id }}" {{ old('hospital_id') == $id ? 'selected' : '' }}>{{ $hospital }}</option>
                    @endforeach
                </select>
                @if($errors->has('hospital'))
                    <span class="text-danger">{{ $errors->first('hospital') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.hospital_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="doctor_id">{{ trans('cruds.workOrder.fields.doctor') }}</label>
                <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id" required>
                    @foreach($doctors as $id => $doctor)
                        <option value="{{ $id }}" {{ old('doctor_id') == $id ? 'selected' : '' }}>{{ $doctor }}</option>
                    @endforeach
                </select>
                @if($errors->has('doctor'))
                    <span class="text-danger">{{ $errors->first('doctor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.doctor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.workOrder.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $patient)
                        <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $patient }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <span class="text-danger">{{ $errors->first('patient') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="modality_id">{{ trans('cruds.workOrder.fields.modality') }}</label>
                <select class="form-control select2 {{ $errors->has('modality') ? 'is-invalid' : '' }}" name="modality_id" id="modality_id">
                    @foreach($modalities as $id => $modality)
                        <option value="{{ $id }}" {{ old('modality_id') == $id ? 'selected' : '' }}>{{ $modality }}</option>
                    @endforeach
                </select>
                @if($errors->has('modality'))
                    <span class="text-danger">{{ $errors->first('modality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.modality_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="procedures">{{ trans('cruds.workOrder.fields.procedure') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('procedures') ? 'is-invalid' : '' }}" name="procedures[]" id="procedures" multiple required>
                    @foreach($procedures as $id => $procedure)
                        <option value="{{ $id }}" {{ in_array($id, old('procedures', [])) ? 'selected' : '' }}>{{ $procedure }}</option>
                    @endforeach
                </select>
                @if($errors->has('procedures'))
                    <span class="text-danger">{{ $errors->first('procedures') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.procedure_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="radiologist_id">{{ trans('cruds.workOrder.fields.radiologist') }}</label>
                <select class="form-control select2 {{ $errors->has('radiologist') ? 'is-invalid' : '' }}" name="radiologist_id" id="radiologist_id">
                    @foreach($radiologists as $id => $radiologist)
                        <option value="{{ $id }}" {{ old('radiologist_id') == $id ? 'selected' : '' }}>{{ $radiologist }}</option>
                    @endforeach
                </select>
                @if($errors->has('radiologist'))
                    <span class="text-danger">{{ $errors->first('radiologist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.radiologist_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.workOrder.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.workOrder.fields.image_helper') }}</span>
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
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.work-orders.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
      uploadedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImageMap[file.name]
      }
      $('form').find('input[name="image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($workOrder) && $workOrder->image)
      var files =
        {!! json_encode($workOrder->image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
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