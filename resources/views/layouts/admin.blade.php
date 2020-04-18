<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body class="sidebar-mini skin-purple" style="height: auto; min-height: 100%;">
    <div class="wrapper" style="height: auto; min-height: 100%;">
        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini"><b>{{ trans('panel.site_title') }}</b></span>
                <span class="logo-lg">{{ trans('panel.site_title') }}</span>
            </a>

            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('global.toggleNavigation') }}</span>
                </a>

                @if(count(config('panel.available_languages', [])) > 1)
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    {{ strtoupper(app()->getLocale()) }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <ul class="menu">
                                            @foreach(config('panel.available_languages') as $langLocale => $langName)
                                                <li>
                                                    <a href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endif

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell-o"></i>
                                @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
                                    @if($alertsCount > 0)
                                        <span class="label label-warning">
                                            {{ $alertsCount }}
                                        </span>
                                    @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="slimScrollDiv" style="position: relative;">
                                        <ul class="menu">
                                            @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                                                @foreach($alerts as $alert)
                                                    <li>
                                                        <a href="{{ $alert->alert_link ? $alert->alert_link : "#" }}" target="_blank" rel="noopener noreferrer">
                                                            @if($alert->pivot->read === 0) <strong> @endif
                                                                {{ $alert->alert_text }}
                                                                @if($alert->pivot->read === 0) </strong> @endif
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li style="text-align:center;">
                                                    {{ trans('global.no_alerts') }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>

        @include('partials.menu')

        <div class="content-wrapper" style="min-height: 960px;">
            @if(session('message'))
                <div class="row" style='padding:20px 20px 0 20px;'>
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                    </div>
                </div>
            @endif
            @if($errors->count() > 0)
                <div class="row" style='padding:20px 20px 0 20px;'>
                    <div class="col-lg-12">
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
        <footer class="main-footer text-center">
            <strong>{{ trans('panel.site_title') }} &copy;</strong> {{ trans('global.allRightsReserved') }}
        </footer>

        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
  let selectAllButtonTrans = '{{ trans('global.select_all') }}'
  let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
        'de': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/German.json',
        'ru': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json',
        'hu': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Hungarian.json',
        'pl': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Polish.json',
        'pt': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese.json',
        'th': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json',
        'sk': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Slovak.json',
        'bn': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Bangla.json',
        'nl': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Dutch.json',
        'tr': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Turkish.json',
        'es': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
        'se': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Swedish.json',
        'it': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Italian.json',
        'ar': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
        'pt-br': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json',
        'id': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json',
        'fr': 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json',
        'gr': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Greek.json',
        'lt': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Lithuanian.json',
        'ro': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Romanian.json',
        'ca': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Catalan.json',
        'zh': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Chinese-traditional.json',
        'bg': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Bulgarian.json',
        'no': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Norwegian-Bokmal.json',
        'mn': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Mongolian.json',
        'ua': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Ukrainian.json',
        'fa': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json',
        'by': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Belarusian.json',
        'sl': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Slovenian.json',
        'fi': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Finnish.json',
        'zh-Hans': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Chinese.json',
        'cs': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Czech.json',
        'lv': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Latvian.json',
        'ps': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Pashto.json',
        'hi': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Hindi.json',
        'he': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Hebrew.json',
        'vi': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Vietnamese.json',
        'dk': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Danish.json',
        'si': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Sinhala.json',
        'ta': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Tamil.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'selectAll',
        className: 'btn-primary',
        text: selectAllButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'selectNone',
        className: 'btn-primary',
        text: selectNoneButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'copy',
        className: 'btn-default',
        text: copyButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'colvis',
        className: 'btn-default',
        text: colvisButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      }
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>
    <script>
        $(document).ready(function () {
    $(".notifications-menu").on('click', function () {
        if (!$(this).hasClass('open')) {
            $('.notifications-menu .label-warning').hide();
            $.get('/admin/user-alerts/read');
        }
    });
});

    </script>
    <script>
        $(document).ready(function() {
    $('.searchable-field').select2({
        minimumInputLength: 3,
        ajax: {
            url: '{{ route("admin.globalSearch") }}',
            dataType: 'json',
            type: 'GET',
            delay: 200,
            data: function (term) {
                return {
                    search: term
                };
            },
            results: function (data) {
                return {
                    data
                };
            }
        },
        escapeMarkup: function (markup) { return markup; },
        templateResult: formatItem,
        templateSelection: formatItemSelection,
        placeholder : '{{ trans('global.search') }}...',
        language: {
            inputTooShort: function(args) {
                var remainingChars = args.minimum - args.input.length;
                var translation = '{{ trans('global.search_input_too_short') }}';

                return translation.replace(':count', remainingChars);
            },
            errorLoading: function() {
                return '{{ trans('global.results_could_not_be_loaded') }}';
            },
            searching: function() {
                return '{{ trans('global.searching') }}';
            },
            noResults: function() {
                return '{{ trans('global.no_results') }}';
            },
        }

    });
    function formatItem (item) {
        if (item.loading) {
            return '{{ trans('global.searching') }}...';
        }
        var markup = "<div class='searchable-link' href='" + item.url + "'>";
        markup += "<div class='searchable-title'>" + item.model + "</div>";
        $.each(item.fields, function(key, field) {
            markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " + item[field] + "</div>";
        });
        markup += "</div>";

        return markup;
    }

    function formatItemSelection (item) {
        if (!item.model) {
            return '{{ trans('global.search') }}...';
        }
        return item.model;
    }
    $(document).delegate('.searchable-link', 'click', function() {
        var url = $(this).attr('href');
        window.location = url;
    });
});

    </script>
    @yield('scripts')
</body>

</html>