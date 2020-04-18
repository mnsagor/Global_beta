<div class="content">
    @can('company_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.companies.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.company.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.company.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-userCompanies">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.web_address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.fb_address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.logo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.company.fields.icon') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $key => $company)
                                    <tr data-entry-id="{{ $company->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $company->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->web_address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $company->fb_address ?? '' }}
                                        </td>
                                        <td>
                                            @if($company->logo)
                                                <a href="{{ $company->logo->getUrl() }}" target="_blank">
                                                    <img src="{{ $company->logo->getUrl('thumb') }}" width="50px" height="50px">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($company->icon)
                                                <a href="{{ $company->icon->getUrl() }}" target="_blank">
                                                    <img src="{{ $company->icon->getUrl('thumb') }}" width="50px" height="50px">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('company_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.companies.show', $company->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('company_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.companies.edit', $company->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('company_delete')
                                                <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.companies.massDestroy') }}",
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
  $('.datatable-userCompanies:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection