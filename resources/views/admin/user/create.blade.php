
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  @include('template.head')
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('template.sidebarAdmin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 ">
            <h1 class="m-0 d-flex justify-content-center">Tambah User</h1>
            <!-- <div class="col-sm-12"> -->
            @if(@isset($ses_nama)) 
            <p align="center">
              Username sudah ada
            </p>
            @endif
          <!-- </div> -->
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container d-flex justify-content-center">
      <form action="{{route('user/store')}}" method="post" >
        {{csrf_field()}}
        <meta name="csrf-token" content="{{csrf_token()}}">
        <div class="row">
          <div class="col-md-12">
            <label>Nama</label>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="nama" placeholder="Nama" required="">
            </div>
            <label>Username</label>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="username" placeholder="Username" required=""></textarea>
            </div>
            <label>Password</label>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="password" placeholder="Password" required=""></textarea>
            </div>
            <label>Level</label>
            <div class="form-group has-feedback col-md-12">
              <label class="mr-2">
              <input type="radio" name="level" value="0">Admin
              </label>
              <label class="mr-2">
              <input type="radio" name="level" value="1">User
              </label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    
    <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    
  </footer>
</div>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
@include('template.script')
 
</body>
</html>