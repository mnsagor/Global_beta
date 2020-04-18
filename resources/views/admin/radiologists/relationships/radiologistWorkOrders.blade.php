<div class="content">
    @can('work_order_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.work-orders.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.workOrder.title_singular') }}
                </a>
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

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-radiologistWorkOrders">
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
                            <tbody>
                                @foreach($workOrders as $key => $workOrder)
                                    <tr data-entry-id="{{ $workOrder->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $workOrder->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workOrder->registration_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workOrder->work_order_status->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workOrder->uploaded_by->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workOrder->data ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workOrder->hospital->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workOrder->doctor->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workOrder->patient->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $workOrder->modality->title ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($workOrder->procedures as $key => $item)
                                                <span class="label label-info label-many">{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $workOrder->radiologist->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($workOrder->image as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('work_order_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.work-orders.show', $workOrder->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('work_order_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.work-orders.edit', $workOrder->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('work_order_delete')
                                                <form action="{{ route('admin.work-orders.destroy', $workOrder->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('work_order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.work-orders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-radiologistWorkOrders:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection