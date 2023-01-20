<!DOCTYPE html>
<html>
<head>
  @include('template.head')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
        <img width="200px" height="150px" src="{{asset('logo_dinkes_semarang.png')}}"><br>
        <center><p><b><font color="black">Peminjaman Aula</font></b></p></center>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    @if(isset($user_pass_error))
    <div style="display:flex; justify-content: center; color: red; font-weight: bold;">{{$user_pass_error}}</div>
    @endif
    <form action="{{route('postLogin')}}" method="post" >
    	{{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username" required="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row justify-content-center">
        <div class="col-xs-4">
          <a href="{{url('daftar')}}" class="btn btn-info btn-block btn-flat">Daftar</a>
        </div>        
        <div class="col-xs-4">
          <a href="{{url('agenda')}}" class="btn btn-warning btn-block btn-flat">Agenda</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div><br>
      <!-- <div class="row">
        <div class="col-xs-12">
          <a href="http://119.2.50.170:9095/e_dispo/index.php/login/resetPassword">Lupa Password</a>
        </div>
      </div> -->
    </form>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
@include('template.script')


</body>
</html>