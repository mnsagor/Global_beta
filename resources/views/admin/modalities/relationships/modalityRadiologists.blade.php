<div class="content">
    @can('radiologist_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.radiologists.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.radiologist.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.radiologist.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-modalityRadiologists">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.radiologist.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.radiologist.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.radiologist.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.radiologist.fields.designation') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.radiologist.fields.hospital') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.radiologist.fields.gender') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.radiologist.fields.modality') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.radiologist.fields.macro') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.radiologist.fields.signature_image') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($radiologists as $key => $radiologist)
                                    <tr data-entry-id="{{ $radiologist->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $radiologist->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $radiologist->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $radiologist->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $radiologist->designation ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($radiologist->hospitals as $key => $item)
                                                <span class="label label-info label-many">{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ App\Radiologist::GENDER_SELECT[$radiologist->gender] ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($radiologist->modalities as $key => $item)
                                                <span class="label label-info label-many">{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($radiologist->macros as $key => $item)
                                                <span class="label label-info label-many">{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($radiologist->signature_image)
                                                <a href="{{ $radiologist->signature_image->getUrl() }}" target="_blank">
                                                    <img src="{{ $radiologist->signature_image->getUrl('thumb') }}" width="50px" height="50px">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('radiologist_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.radiologists.show', $radiologist->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('radiologist_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.radiologists.edit', $radiologist->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('radiologist_delete')
                                                <form action="{{ route('admin.radiologists.destroy', $radiologist->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('radiologist_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.radiologists.massDestroy') }}",
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
  $('.datatable-modalityRadiologists:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection