
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
  @include('template.sidebarPengguna')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 d-flex justify-content-center">Edit User</h1>
            @if(@isset($nama)) 
            <p align="center"; style="color:red">
              {{$nama}}
            </p>
            @endif
          </div><!-- /.col -->
          
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container d-flex justify-content-center">
    <form action="{{url('user/update', $pengguna->id)}}" method="post" >
        {{csrf_field()}}
        <meta name="csrf-token" content="{{csrf_token()}}">
      <div class="row">
        <div class="col">
          <label>Nama</label>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="nama" value="{{$pengguna->nama}}" required="">
            </div>
            <label>Username</label>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="username" value="{{$pengguna->username}}" required=""></textarea>
            </div>
            <!-- <label>Password</label> -->
            <div id="idpass" class="form-group has-feedback">
              <input type="text" class="form-control" name="password" value="{{$pengguna->password}}" required="" readonly></textarea>
            </div>
            <label>Password Baru</label>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Kosongkan Jika Tidak" name="passwordbaru"></input>
            </div>
            <!-- <label>Level</label> -->
            <div id="idrlevel" class="form-group has-feedback">
              <label class="mr-2" >
              <input type="radio" name="level" value="0" <?php if ($pengguna->level=="0"){echo 'checked';} ?> >Admin
              </label>

              <label class="mr-2">
              <input type="radio" name="level" value="1" <?php if ($pengguna->level=="1"){echo 'checked';} ?>>User
              </label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
            </div>
        </div>
      </div>
    </form>
    </div>
    <!-- /.content -->
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
<script type="text/javascript">
  $(function() {
    document.getElementById('iduser').style.backgroundColor = "rgba(255,255,255,.1)";
    document.getElementById('idpuser').style.color = "white"; 

    document.getElementById('idpass').style.display="none";
    document.getElementById('idpass').style.visibility="hidden";

    document.getElementById('idrlevel').style.display="none";
    document.getElementById('idrlevel').style.visibility="hidden";
  });
</script>
</body>
</html>