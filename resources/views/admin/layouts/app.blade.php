<!doctype html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8"/>
    <title>NCS Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="NCS Dashboard"
          name="NCS Dashboard"/>
    <meta content="NCS Dashboard" name="NCS"/>
    <link rel="shortcut icon" href="{{asset('admin_assets/images/logo.png')}}">
    <link rel="icon" href="{{asset('admin_assets/images/logo.png')}}">

@yield('extra-css')

<!-- Bootstrap Css -->
    <link href="{{asset('admin_assets/libs/toastr/build/toastr.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('admin_assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('admin_assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    @yield('extra-last-css')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>

<body data-sidebar="dark" data-layout-mode="light">
<div id="layout-wrapper">


@include('admin.layouts.includes.top-bar')
<!-- ========== Left Sidebar Start ========== -->
    @include('admin.layouts.includes.menu')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @yield('content')
            </div>
        </div>

        <footer class="footer no-print">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script>
                        Copy Rights <a
                            href="" target="_blank">NCS</a>.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Copy Rights
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Left Sidebar End -->

    </div>
    <!-- END layout-wrapper -->
</div>

<!-- Right Sidebar -->
@include('admin.layouts.includes.right-bar')
<!-- /Right-bar -->


<!-- JAVASCRIPT -->
<script src="{{asset('admin_assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/toastr/build/toastr.min.js')}}"></script>

@yield('extra-js')
<!-- apexcharts -->
<!-- App js -->
{{--<script src="{{asset('admin_assets/js/app.js')}}"></script>--}}
@yield('add-product-js')
{{--    @if(app()->getLocale()=='ar')--}}
<script>
    $('.datatable.dt-responsive').DataTable({
        language: {
            url: '{{asset('admin_assets/ar.json')}}'
        },
        "bPaginate": false,
    });

</script>
@if(Session::has('success'))
    <script>
        toastr["success"]("Done Successfully")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 100,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    </script>
@endif
@if ($errors->any())

    <script>
        toastr["error"]("{{'Please Check All Entered Data'}}")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 100,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    </script>

@endif


</body>

@yield('modal')

</html>
