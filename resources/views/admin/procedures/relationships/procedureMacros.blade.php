<div class="content">
    @can('macro_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.macros.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.macro.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.macro.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-procedureMacros">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.macro.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.macro.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.macro.fields.modality') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.macro.fields.procedure') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.macro.fields.status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($macros as $key => $macro)
                                    <tr data-entry-id="{{ $macro->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $macro->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $macro->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $macro->modality->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $macro->procedure->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Macro::STATUS_SELECT[$macro->status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('macro_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.macros.show', $macro->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('macro_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.macros.edit', $macro->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('macro_delete')
                                                <form action="{{ route('admin.macros.destroy', $macro->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('macro_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.macros.massDestroy') }}",
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
  $('.datatable-procedureMacros:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection