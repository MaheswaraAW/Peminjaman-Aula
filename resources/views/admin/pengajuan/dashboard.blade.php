
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
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{url('pengajuan/semua')}}">SEMUA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('pengajuan/hariini')}}">HARI INI</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('pengajuan/bulanini')}}">BULAN INI</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('pengajuan/tahunini')}}">TAHUN INI</a>
            </li>
          </ul>
        </div>
      </nav>
          <a href="{{route('pengajuan/create')}}" class="btn btn-success btn-lg btn-block" role="button" aria-pressed="true">PENGAJUAN</a>
          <table class="table table-bordered">
              <thead class="bg-primary text-light">
                  <tr>
                      <th>NO</th>
                      <th>TANGGAL</th>
                      <th>JAM</th>
                      <th>ACARA</th>
                      <th>TEMPAT</th>
                      <th>BIDANG</th>
                      <th>SEKSI</th>
                      <th>PEMESAN</th>
                      <th>KETERANGAN</th>
                      <th>AKSI</th>
                  </tr>
              </thead>
              <tbody>

              @foreach($pengajuan as $key=>$pj)
              
              <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$pj->tanggal}}</td>
                  <td>{{$pj->jam_m."-".$pj->jam_s}}</td>
                  <td>{{$pj->acara}}</td>
                  <td>{{$pj->tempat}}</td>
                  <td>{{$pj->bidang}}</td>
                  <td>{{$pj->seksi}}</td>
                  <td>{{$pj->pemesan}}</td>
                  <td>{{$pj->keterangan}}</td>
                  <td>
                      <a href="{{url('pengajuan/edit',$pj->id)}}" class="btn btn-info btn-md"></i>Edit</a>
                      <a href="{{url('delete_pesan',$pj->id)}}" class="btn btn-danger btn-md"></i>Delete</a>
                  </td>
              </tr>
              @endforeach
              </tbody>

          </table>  
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
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
@include('template.script')
<script type="text/javascript">
  $(document).ready( function () {
    $('#idtable').DataTable(
    {
      responsive: true
    });
  });
</script>
</body>
</html>