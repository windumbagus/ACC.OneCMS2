<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="{{ asset('assets/accone-logo.png') }}"> 
  <title>ACC.OneCMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/morris.js/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- Pace style -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/pace/pace.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="{{ asset('assets/googlefont.css') }}">
</head>

<!-- jQuery 3 -->
<script src="{{ asset('assets/adminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/adminLTE/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
  
  //alert flash out
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
  }, 3000);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('assets/adminLTE/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/adminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('assets/adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/adminLTE/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('assets/adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('assets/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('assets/adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/adminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/adminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('assets/adminLTE/dist/js/pages/dashboard.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('assets/adminLTE/dist/js/demo.js') }}"></script> --}}

{{-- XLSX to JSON --}}
<script src="{{ asset('assets/xlsx.full.min.js') }}"></script>

{{-- CKEDITOR --}}
<script src="{{ asset('assets/AdminLTE/bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- PACE -->
<script src="{{ asset('assets/adminLTE/bower_components/PACE/pace.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('assets/adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/buttons.html5.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/jszip.min.js') }}"></script> --}}

{{-- Sweet Alert --}}
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

{{-- <!-- iCheck -->
<script src="{{ asset('assets/adminLTE/plugins/iCheck/icheck.min.js') }}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script> --}}
{{-- @dd($session); --}}
{{-- {{$session[0]->LoginSession}} --}}
{{-- {!! $session->LoginSession !!} --}}
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">
      <!-- Main Header -->
      @include('admin/header')
      <!-- sidebar -->
      @include('admin/sidebar')

      <!-- Content Wrapper -->
      <div class="content-wrapper">
        <section class="content">
          
          <div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif

            @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>{{ $message }}</strong>
            </div>
            @endif

            @if ($message = Session::get('info'))
            <div class="alert alert-info alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>{{ $message }}</strong>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>{{ $errors }}</strong>

            </div>
            @endif
          </div>

            @yield('content')
        
          </section>
      </div>

      <!-- Footer -->
      @include('admin/footer')
    </div>
  </body>
</html>
