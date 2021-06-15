<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Satgas | Log in</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="{{ asset('adminlte/dist/img/icon.png') }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Sweetalert 2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/adtv/sweetalert2/sweetalert2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <!-- ADTV style -->
  <link rel="stylesheet" href="{{ asset('adminlte/adtv/css/custom.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition">
  <div id="preloader"></div>
  <div class="login-page">
    <div class="login-box">

      <div class="login-logo">
        <a href="javascript:void()"><b>Satgas</b> COVID19</a>
      </div>
      <!-- /.login-logo -->

      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form method="post" id="login-form">

            <div class="input-group mb-3">
              <input type="username" class="form-control" placeholder="Username" id="username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user" style="width: 15px;"></span>
                </div>
              </div>
              <!-- <span id="username_error" class="error invalid-feedback">Please enter a email address</span> -->
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" id="password">
              <div class="input-group-append">
                <div class="input-group-text" id="btn-show-pass">
                  <span class="fas fa-eye-slash" id="ic-show-pass" style="width: 15px;"></span>
                </div>
              </div>
              <!-- <span id="password_error" class="error invalid-feedback">Please enter a email address</span> -->
            </div>

            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember" id="label-remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>

          </form>

        </div>
        <!-- /.login-card-body -->
      </div>
      <!-- /.login-card -->
    </div>
    <!-- /.login-box -->
  </div>


  <!-- jQuery -->
  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Sweetalert 2 -->
  <script src="{{ asset('adminlte/adtv/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
  <!-- ADTV App -->
  <script src="{{ asset('adminlte/adtv/js/custom.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#username').focus();


      var btn_pass = $('#btn-show-pass');
      var pass = $('#password');

      btn_pass.click(function() {
        if (pass.attr('type') === "password") {
          pass.attr('type', 'text');
          $('#ic-show-pass').addClass('show-pass')
          .removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
          pass.attr('type','password');
          $('#ic-show-pass').removeClass('show-pass')
          .removeClass('fa-eye').addClass('fa-eye-slash');
        }
      });

      $('#login-form').submit(function(e) {

        var username = $('#username').val();
        var password = $('#password').val();
        var remember = $('#remember')[0].checked;

        var data = {
          username: username,
          password: password,
          remember: remember
        };

        var url = '{{ route("satgas.post_login") }}';

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "post",
          url: url,
          dataType: 'json',
          data: data,
          cache: false,
          beforeSend: function()
          {
            $('.invalid-feedback').hide();
            $('input').removeClass('is-invalid');
            ToastLoader.fire();
          },
          success: function (data)
          {
            if (data.status == "Success") {
              Toast.fire({
                icon: 'success',
                title: data.message,
                onClose: () => {
                  window.location = data.url;
                }
              });
            } else {
              Toast.fire({
                icon: 'error',
                title: data.message,
                onBeforeOpen: () => {
                  $('#password').val('').focus();
                  $('#username').focus().select();
                }
              });
            }
          },
          error: function (request, status, error) {
            Swal.close();
            $('.invalid-feedback').empty();
            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value) {
              $('.invalid-feedback').show();
              $('#' + key).addClass('is-invalid');
            });
          }
        });

        return false;
      });
    });
  </script>

</body>
</html>