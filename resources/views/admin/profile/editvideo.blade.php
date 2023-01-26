
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12" style="text-align: center">
            <h1 class="m-0">Edit Video</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container ">
      <form action="{{ route('profile/update/video', $profile->id) }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="d-flex justify-content-sm-center">
          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label class="ml-2">Video</label>
              <input type="text" class="form-control" name="video" value="{{$profile->video}}" readonly="">
            </div>
            <div class="form-group">
              <label class="ml-2">File</label>
              <input type="file" class="form-control" name="file">
            </div>
            <div class="form-group has-feedback">
              <label class="ml-2">Nama</label>
              <input type="text" class="form-control" name="nama" value="{{$profile->nama}}" required="">
            </div>
            <div class="form-group has-feedback">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    
    <!-- /.content -->
    </div>
  </div>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
@include('template.script')
<script type="text/javascript">
$(function() {
  document.getElementById('idProfile').style.backgroundColor = "rgba(255,255,255,.1)";
  document.getElementById('idpProfile').style.color = "white";
});
</script>
</body>
</html>