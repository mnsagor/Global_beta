@extends('layouts.admin')
@section('content')
<div class="content">
    @can('work_order_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.work-orders.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.workOrder.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'WorkOrder', 'route' => 'admin.work-orders.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.workOrder.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-WorkOrder">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.registration_number') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.work_order_status') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.uploaded_by') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.data') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.hospital') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.doctor') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.patient') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.modality') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.procedure') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.radiologist') }}
                                </th>
                                <th>
                                    {{ trans('cruds.workOrder.fields.image') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('work_order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.work-orders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.work-orders.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'registration_number', name: 'registration_number' },
{ data: 'work_order_status_title', name: 'work_order_status.title' },
{ data: 'uploaded_by_name', name: 'uploaded_by.name' },
{ data: 'data', name: 'data' },
{ data: 'hospital_title', name: 'hospital.title' },
{ data: 'doctor_name', name: 'doctor.name' },
{ data: 'patient_name', name: 'patient.name' },
{ data: 'modality_title', name: 'modality.title' },
{ data: 'procedure', name: 'procedures.title' },
{ data: 'radiologist_name', name: 'radiologist.name' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-WorkOrder').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection