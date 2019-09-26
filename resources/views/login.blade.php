<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="assets/accone-logo.png"> 
  <title>ACC.One CMS | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/adminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/adminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/adminLTE/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/adminLTE/plugins/iCheck/all.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="css/googlefont.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <div class="login-box-body">
    <div class="login-logo">
        <img src="assets/accone-logo.png" alt="" style="Height:45%; width:45%; margin-top:5%;"><br>
      <h3><b>ACC.One CMS</b></h3>
      <h4>AstraCreditCompany</h4>
    </div>
    <!-- /.login-logo -->
    <form action="{{ asset('login-process') }}" method="post">
        @csrf

        @if (isset($error))
          @if (!$error==null)
          <span class="invalid-feedback" role="alert">
            <strong>{{ $error }}</strong>
          </span>
          @endif
        @endif

      <div class="form-group has-feedback"> 
          <input id="Username" type="text" class="form-control" name="Username" required autocomplete="Username" autofocus placeholder="Username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
            <input id="Password" type="Password" class="form-control" name="Password" required autocomplete="current-password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" id="ShowPass"> Show Password
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> LogIn</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
  <p style="margin-top:10%" class="login-box-msg"><strong>Copyright &copy; 2019 <a href="#">WMB & FZN</a>.</strong>  All rights reserved.</p>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="assets/adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/adminLTE/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });

  //set type on input form
  $('#ShowPass').on('ifChanged', function(){
        var x = $('#ShowPass').is(':checked')
        if(x == true){
            document.getElementById('Password').setAttribute('type', 'text')
        }else{
            document.getElementById('Password').setAttribute('type', 'password')
        }
    })

</script>
</body>
</html>
