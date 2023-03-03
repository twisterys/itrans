<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Smart Trans</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    
    <link href="{{ asset('libs/jquery-ui/toastr.css')}}" rel="stylesheet"/>

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link href="{{ asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    

    @include('layouts.head')
</head>

@section('body')
@show
<body data-layout="detached" data-topbar="colored">
    <!-- Loader -->
    {{--<div id="preloader">--}}
        {{--<div id="status">--}}
            {{--<div class="spinner-chase">--}}
                {{--<div class="chase-dot"></div>--}}
                {{--<div class="chase-dot"></div>--}}
                {{--<div class="chase-dot"></div>--}}
                {{--<div class="chase-dot"></div>--}}
                {{--<div class="chase-dot"></div>--}}
                {{--<div class="chase-dot"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-- Begin page -->
    <div class="container-fluid">
        <div id="layout-wrapper">
            @include('layouts.topbar')
            @include('layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                <!-- End Page-content -->
                @include('layouts.footer')
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
    </div>
    <!-- END container-fluid -->


    <!-- Right Sidebar -->
    @include('layouts.right-sidebar')
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts.footer-script')
</body>
<script src="{{ asset('libs/jquery-ui/toastr.min.js')}}"></script>
<script src="{{ asset('libs/jquery-ui/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('libs/jquery-ui/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script>
    $(document).ready(function() {
      toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
    }
        @if (Session::has('message'))
          toastr.success('{{ Session::get('message') }}');
        @endif
        @if (Session::has('warning'))
          toastr.warning('{{ Session::get('warning') }}');
        @endif
        @if (Session::has('error'))
          toastr.error('{{ Session::get('error') }}');
        @endif
    });
</script>




</html>
