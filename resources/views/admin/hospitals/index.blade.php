@extends('layouts.admin')
@section('content')
<div class="content">
    @can('hospital_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.hospitals.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.hospital.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Hospital', 'route' => 'admin.hospitals.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.hospital.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Hospital">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.title') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.status') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.hospital_code') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.manager_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.manager_phone_number') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.techonologist_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.technologist_phone_number') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.receptionist_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.receptionist_phone_number') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.route_title') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.route_ae_title') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.route_host_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.route_port') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.pacs_destinaiton_ae_title') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.pacs_ae_title') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.pacs_host_name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.hospital.fields.pacs_port') }}
                                </th>
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.proprietor_name') }}--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.proprietor_phone_number') }}--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.chairman_name') }}--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.chairman_phone_number') }}--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.director_name') }}--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.director_phone_number') }}--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.accountant_name') }}--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.accountant_phone_number') }}--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.user') }}--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    {{ trans('cruds.hospital.fields.modality') }}--}}
{{--                                </th>--}}
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
@can('hospital_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hospitals.massDestroy') }}",
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
    ajax: "{{ route('admin.hospitals.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'status', name: 'status' },
{ data: 'hospital_code', name: 'hospital_code' },
{ data: 'manager_name', name: 'manager_name' },
{ data: 'manager_phone_number', name: 'manager_phone_number' },
{ data: 'techonologist_name', name: 'techonologist_name' },
{ data: 'technologist_phone_number', name: 'technologist_phone_number' },
{ data: 'receptionist_name', name: 'receptionist_name' },
{ data: 'receptionist_phone_number', name: 'receptionist_phone_number' },
{ data: 'route_title', name: 'route_title' },
{ data: 'route_ae_title', name: 'route_ae_title' },
{ data: 'route_host_name', name: 'route_host_name' },
{ data: 'route_port', name: 'route_port' },
{ data: 'pacs_destinaiton_ae_title', name: 'pacs_destinaiton_ae_title' },
{ data: 'pacs_ae_title', name: 'pacs_ae_title' },
{ data: 'pacs_host_name', name: 'pacs_host_name' },
{ data: 'pacs_port', name: 'pacs_port' },
        // { data: 'proprietor_name', name: 'proprietor_name' },
        // { data: 'proprietor_phone_number', name: 'proprietor_phone_number' },
        // { data: 'chairman_name', name: 'chairman_name' },
        // { data: 'chairman_phone_number', name: 'chairman_phone_number' },
        // { data: 'director_name', name: 'director_name' },
        // { data: 'director_phone_number', name: 'director_phone_number' },
        // { data: 'accountant_name', name: 'accountant_name' },
        // { data: 'accountant_phone_number', name: 'accountant_phone_number' },
        // { data: 'user_name', name: 'user.name' },
        // { data: 'modality', name: 'modalities.title' },

{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-Hospital').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection
