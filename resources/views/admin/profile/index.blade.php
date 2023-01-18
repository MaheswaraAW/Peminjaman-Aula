
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  @include('template.head')
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
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="card">
          <div class="card-body">
            <div class="card" >
              <div class="card-body" style="display:flex; align-items:center; justify-content: center;">
                <video width="70%" height="70%" controls>
                  <source src="{{asset('video/'.$profile->video)}}" type="video/mp4">
                </video>
              </div>
              <h3 style="text-align: center">{{$profile->nama}}</h3>
              <marquee><b>{{$profile->teks_berjalan}}</b></marquee>
            </div>
            
            <a href="{{route('profile/edit',$profile->id)}}" class="btn btn-success btn-lg btn-block" role="button" aria-pressed="true">EDIT</a>
          </div>

        </div>   
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
</body>
</html>