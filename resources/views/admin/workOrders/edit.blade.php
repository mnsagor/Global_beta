@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.workOrder.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.work-orders.update", [$workOrder->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('registration_number') ? 'has-error' : '' }}">
                            <label class="required" for="registration_number">{{ trans('cruds.workOrder.fields.registration_number') }}</label>
                            <input class="form-control" type="text" name="registration_number" id="registration_number" value="{{ old('registration_number', $workOrder->registration_number) }}" required>
                            @if($errors->has('registration_number'))
                                <span class="help-block" role="alert">{{ $errors->first('registration_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.workOrder.fields.registration_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('work_order_status') ? 'has-error' : '' }}">
                            <label class="required" for="work_order_status_id">{{ trans('cruds.workOrder.fields.work_order_status') }}</label>
                            <select class="form-control select2" name="work_order_status_id" id="work_order_status_id" required>
                                @foreach($work_order_statuses as $id => $work_order_status)
                                    <option value="{{ $id }}" {{ ($workOrder->work_order_status ? $workOrder->work_order_status->id : old('work_order_status_id')) == $id ? 'selected' : '' }}>{{ $work_order_status }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('work_order_status'))
                                <span class="help-block" role="alert">{{ $errors->first('work_order_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.workOrder.fields.work_order_status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('uploaded_by') ? 'has-error' : '' }}">
                            <label class="required" for="uploaded_by_id">{{ trans('cruds.workOrder.fields.uploaded_by') }}</label>
                            <select class="form-control select2" name="uploaded_by_id" id="uploaded_by_id" required>
                                @foreach($uploaded_bies as $id => $uploaded_by)
                                    <option value="{{ $id }}" {{ ($workOrder->uploaded_by ? $workOrder->uploaded_by->id : old('uploaded_by_id')) == $id ? 'selected' : '' }}>{{ $uploaded_by }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('uploaded_by'))
                                <span class="help-block" role="alert">{{ $errors->first('uploaded_by') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.workOrder.fields.uploaded_by_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                            <label class="required" for="date">{{ trans('cruds.workOrder.fields.date') }}</label>
                            <input class="form-control datetime" type="text" name="date" id="date" value="{{ old('date', $workOrder->date) }}" required>
                            @if($errors->has('date'))
                                <span class="help-block" role="alert">{{ $errors->first('date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.workOrder.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('hospital') ? 'has-error' : '' }}">
                            <label class="required" for="hospital_id">{{ trans('cruds.workOrder.fields.hospital') }}</label>
                            <select class="form-control select2" name="hospital_id" id="hospital_id" required>
                                @foreach($hospitals as $id => $hospital)
                                    <option value="{{ $id }}" {{ ($workOrder->hospital ? $workOrder->hospital->id : old('hospital_id')) == $id ? 'selected' : '' }}>{{ $hospital }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('hospital'))
                                <span class="help-block" role="alert">{{ $errors->first('hospital') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.workOrder.fields.hospital_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('doctor') ? 'has-error' : '' }}">
                            <label class="required" for="doctor_id">{{ trans('cruds.workOrder.fields.doctor') }}</label>
                            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                @foreach($doctors as $id => $doctor)
                                    <option value="{{ $id }}" {{ ($workOrder->doctor ? $workOrder->doctor->id : old('doctor_id')) == $id ? 'selected' : '' }}>{{ $doctor }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('doctor'))
                                <span class="help-block" role="alert">{{ $errors->first('doctor') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.workOrder.fields.doctor_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('patient') ? 'has-error' : '' }}">
                            <label class="required" for="patient_id">{{ trans('cruds.workOrder.fields.patient') }}</label>
                            <select class="form-control select2" name="patient_id" id="patient_id" required>
                                @foreach($patients as $id => $patient)
                                    <option value="{{ $id }}" {{ ($workOrder->patient ? $workOrder->patient->id : old('patient_id')) == $id ? 'selected' : '' }}>{{ $patient }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('patient'))
                                <span class="help-block" role="alert">{{ $errors->first('patient') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.workOrder.fields.patient_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('modality') ? 'has-error' : '' }}">
                            <label class="required" for="modality_id">{{ trans('cruds.workOrder.fields.modality') }}</label>
                            <select class="form-control select2 dynamic" name="modality_id" id="modality_id"  data-dependent="procedure_id" required>
                                @foreach($modalities as $id => $modality)
                                    <option value="{{ $id }}" {{ ($workOrder->modality ? $workOrder->modality->id : old('modality_id')) == $id ? 'selected' : '' }}>{{ $modality }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('modality'))
                                <span class="help-block" role="alert">{{ $errors->first('modality') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.workOrder.fields.modality_helper') }}</span>
                        </div>
{{--                        <div class="form-group {{ $errors->has('procedures') ? 'has-error' : '' }}">--}}
{{--                            <label class="required" for="procedures">{{ trans('cruds.workOrder.fields.procedure') }}</label>--}}
{{--                            <div style="padding-bottom: 4px">--}}
{{--                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>--}}
{{--                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>--}}
{{--                            </div>--}}
{{--                            <select class="form-control select2" name="procedures[]" id="procedures" multiple required>--}}
{{--                                @foreach($procedures as $id => $procedure)--}}
{{--                                    <option value="{{ $id }}" {{ (in_array($id, old('procedures', [])) || $workOrder->procedures->contains($id)) ? 'selected' : '' }}>{{ $procedure }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @if($errors->has('procedures'))--}}
{{--                                <span class="help-block" role="alert">{{ $errors->first('procedures') }}</span>--}}
{{--                            @endif--}}
{{--                            <span class="help-block">{{ trans('cruds.workOrder.fields.procedure_helper') }}</span>--}}
{{--                        </div>--}}
                        <div class="form-group {{ $errors->has('procedure') ? 'has-error' : '' }}">
                            <label class="required" for="procedure_id">{{ trans('cruds.workOrder.fields.procedure') }}</label>
                            <select class="form-control select2" name="procedure_id" id="procedure_id" required>
                                @foreach($procedures as $id => $procedure)
                                    <option value="{{ $id }}" {{ ($workOrder->procedure ? $workOrder->procedure->id : old('procedure_id')) == $id ? 'selected' : '' }}>{{ $procedure }}</option>
                                @endforeach
                            </select>
                                @if($errors->has('procedure'))
                                    <span class="help-block" role="alert">{{ $errors->first('procedure') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.workOrder.fields.procedure_helper') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('radiologist') ? 'has-error' : '' }}">
                            <label for="radiologist_id">{{ trans('cruds.workOrder.fields.radiologist') }}</label>
                            <select class="form-control select2" name="radiologist_id" id="radiologist_id">
                                @foreach($radiologists as $id => $radiologist)
                                    <option value="{{ $id }}" {{ ($workOrder->radiologist ? $workOrder->radiologist->id : old('radiologist_id')) == $id ? 'selected' : '' }}>{{ $radiologist }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('radiologist'))
                                <span class="help-block" role="alert">{{ $errors->first('radiologist') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.workOrder.fields.radiologist_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label class="required" for="image">{{ trans('cruds.workOrder.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
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



        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
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
