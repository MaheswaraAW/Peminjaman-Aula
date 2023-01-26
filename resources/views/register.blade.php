<!DOCTYPE html>
<html>

<head>
    @include('template.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img width="200px" height="150px" src="http://119.2.50.170:9095/e_dispo/assets/temp/logo.png"><br>
            <center>
                <p><b>
                        <font color="black">Daftar User</font>
                    </b></p>
            </center>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            @if (@isset($cek))
                <p align="center" style="color: red; font-weight: bold">
                    Username Sudah Ada
                </p>
            @endif

            <form action="{{ route('postDaftar') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nama" placeholder="Nama" required="">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <!-- <div class="row justify-content-center"> -->
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
                </div>
                <!-- /.col -->
                <!-- </div><br> -->
            </form>
            <!-- /.social-auth-links -->
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    @include('template.script')

    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>

</html>
