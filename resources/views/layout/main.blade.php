<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title'){{ trim($__env->yieldContent('title')) ? ' - ' : '' }}{{ $general_setting->site_title }}
    </title>

    <link rel="icon" href="{{ asset($general_setting->site_logo) }}" />
    <link rel="manifest" href="{{ url('manifest.json') }}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-timepicker/jquery.timepicker.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap-select.min.css') }}" type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" type="text/css">
    <!-- Drip icon font-->
    <link rel="stylesheet" href="{{ asset('vendor/dripicons/webfont.css') }}" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{ asset('css/grasp_mobile_progress_circle-1.0.0.min.css') }}" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet"
        href="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}" type="text/css">
    <!-- virtual keybord stylesheet-->
    <link rel="stylesheet" href="{{ asset('vendor/keyboard/css/keyboard.css') }}" type="text/css">
    <!-- date range stylesheet-->
    <link rel="stylesheet" href="{{ asset('vendor/daterange/css/daterangepicker.min.css') }}" type="text/css">
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.default.css') }}" id="theme-stylesheet" type="text/css">

    {{-- select 2 css --}}
    {{--
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}" type="text/css"> --}}

    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- sweetalert2 --}}
    <script src="{{ asset('vendor/sweetalert2/css/sweetalert2.min.css') }}"></script>
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.timepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/popper.js/umd/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/keyboard/js/jquery.keyboard.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('vendor/keyboard/js/jquery.keyboard.extension-autocomplete.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('js/charts-custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/front.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/daterange/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/daterange/js/knockout-3.4.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/daterange/js/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>

    <!-- table sorter js-->
    <script type="text/javascript" src="{{ asset('vendor/datatable/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatable/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatable/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatable/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatable/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatable/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatable/buttons.print.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('vendor/datatable/sum().js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatable/dataTables.checkboxes.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js">
    </script>
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('css/custom-default.css') }}" type="text/css" id="custom-style">
    <script src="{{ asset('js/jquery.maskMoney.js') }}"></script>

    {{-- select 2 js --}}
    {{-- <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script> --}}

    {{-- sweetalert2 --}}
    <script src="{{ asset('vendor/sweetalert2/js/sweetalert2.all.min.js') }}"></script>

    <!-- multi select filter -->
    <link rel="stylesheet" href="<?php echo asset('vendor/filter-multi-select/filter_multi_select.css'); ?>"
        type="text/css">
    <script type="text/javascript"
        src="<?php echo asset('vendor/filter-multi-select/filter-multi-select-bundle.min.js'); ?>"></script>



    @yield('css')
</head>

<body onload="myFunction()">
    <div id="loader"></div>
    <!-- Side Navbar -->
    @include('layout.sidebar')
    @if (!@$pos_view)
    <!-- navbar-->
    @include('layout.navbar')
    @endif


    <div class="page">

        <!-- notification modal -->
        @include('main_utilities.notification_modal')
        <!-- end notification modal -->

        <!-- expense modal -->
        @include('main_utilities.expense_modal')
        <!-- end expense modal -->

        <!-- account modal -->
        @include('main_utilities.account_modal')
        <!-- end account modal -->

        <!-- account statement modal -->
        @include('main_utilities.account_statement_modal')
        <!-- end account statement modal -->

        <!-- warehouse modal -->
        @include('main_utilities.warehouse_modal')
        <!-- end warehouse modal -->

        <!-- user modal -->
        @include('main_utilities.user_modal')
        <!-- end user modal -->

        <!-- customer modal -->
        @include('main_utilities.customer_modal')
        <!-- end customer modal -->

        <!-- supplier modal -->
        @include('main_utilities.supplier_modal')
        <!-- end supplier modal -->

        <div style="display:none" id="content" class="animate-bottom">

            @if (session()->has('type'))
            <div class="alert {{ session()->get('type') }} alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> {{ session()->get('message') }}
            </div>
            @endif

            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <p>&copy; {{ $general_setting->site_title }} | {{ trans('file.Developed') }} {{ trans('file.By')
                            }} <span class="external">{{ $general_setting->developed_by }}</span></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="pos-page d-none">
        <div id="content-pos">
            @yield('content-pos')
        </div>
    </div>

    <!-- GLOBAL JS -->
    <script>
        const baseUrl = "{{ url('/') }}";
        const user_verified = "{{ env('USER_VERIFIED') }}";
        const translations = {
            recordsPerPage: "{{ __('file.records per page') }}",
            search : "{{ __('file.Search') }}",
            showing : "{{ __('file.Showing') }}",
            pdf : "{{ __('file.PDF') }}",
            csv : "{{ __('file.CSV') }}",
            print : "{{ __('file.Print') }}",
            colvis : "{{ __('file.Column visibility') }}",
        };
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    </script>
    <!-- END GLOBAL JS -->
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
