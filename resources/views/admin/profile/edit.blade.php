
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
            <h1 class="m-0">Edit Profile</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container ">
      <form action="{{ route('profile/store') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="d-flex justify-content-sm-center">
          <div class="col-md-12">
            <div class="form-group has-feedback">
              <table class="table table-bordered">
              <thead class="bg-primary text-light">
                <tr>
                    <th>NO</th>
                    <th>VIDEO</th>
                    <th>NAMA</th>
                    <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                @foreach($profile as $key=>$pr)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                      <video width="30%" height="20%" controls>
                        <source src="{{asset('video/'.$pr->video)}}" type="video/mp4">
                      </video>
                    </td>
                    <td>{{$pr->nama}}</td>
                    <td> 
                      <a href="{{url('profile/edit/video',$pr->id)}}" class="btn btn-info btn-md"></i>Edit</a>
                      <a href="{{url('profile/delete/video',$pr->id)}}" class="btn btn-danger btn-md"></i>Delete</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="4">
                    <a href="{{url('profile/create')}}" class="btn btn-success btn-md" style="width: 100%"></i>Tambah Video</a>
                  </td>
                </tr>
              </tbody>

          </table>
              
            <div class="form-group has-feedback">
              <label class="ml-2">Teks Berjalan</label>
              <textarea type="text" class="form-control" name="teks_berjalan"required="">{{$teks}}</textarea>

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