<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UnitedCompany | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
   
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('front/css/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo" style=" border-radius:5px;">
       
      <a href="{{url('/')}}"><img style="margin-top: 25px" width="200px" height="150px" src="{{asset('img/logo2.png')}}" alt=""></a>
          
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      
        <p class="login-box-msg">Ingrese sus datos de Acceso</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">                
         {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input id="login" type="login" class="form-control" name="email" value="{{ old("email") }}" required autofocus>
            @if ($errors->has("email"))
                <span class="help-block">
                    <strong>{{ $errors->first("email") }}</strong>
                </span>
            @endif
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input id="password" type="password" class="form-control" name="password" required>
             @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Recordar
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
            </div><!-- /.col -->
            <p class="text-center">Aún no es nuevo miembro? <a href="{{url('register')}}">Registrese</a></p>
            
          </div>
        </form>

        
        <a href="#">Olvidé mi password</a><br>
        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('js/icheck.min.js')}}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          //increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
