
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
  @include('template.sidebarPengguna')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto ml-auto">
                      <li class="nav-item" id="idsemua">
                        <a class="nav-link" href="{{url('pengajuan/daftarsaya/semua')}}" id="idasemua">SEMUA</a>
                      </li>
                      <li class="nav-item" id="idhariini">
                        <a class="nav-link" href="{{url('pengajuan/daftarsaya/hariini')}}" id="idahariini">HARI INI</a>
                      </li>
                      <li class="nav-item" id="idbulanini">
                        <a class="nav-link" href="{{url('pengajuan/daftarsaya/bulanini')}}" id="idabulanini">BULAN INI</a>
                      </li>
                      <li class="nav-item" id="idtahunini">
                        <a class="nav-link" href="{{url('pengajuan/daftarsaya/tahunini')}}" id="idatahunini">TAHUN INI</a>
                      </li>
                    </ul>
                    
                  </div>
                </nav>
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
                          <a href="{{url('pengajuan/daftarsaya/edit',$pj->id)}}" class="btn btn-info btn-md"></i>Edit</a>
                        </td>
                    </tr>
                    @endforeach

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
@include('template.script')
<?php if(isset($bgsemua)) { ?>
  <script>
  $(document).ready(function(){
    document.getElementById('idsemua').style.backgroundColor = "#007bff";
    document.getElementById('idasemua').style.color = "white";
    document.getElementById('idasemua').style.fontWeight = "bold";
  });
  </script>
<?php } ?>
<?php if(isset($bghariini)) { ?>
  <script>
  $(document).ready(function(){
    document.getElementById('idhariini').style.backgroundColor = "#007bff";
    document.getElementById('idahariini').style.color = "white";
    document.getElementById('idahariini').style.fontWeight = "bold";
  });
  </script>
<?php } ?>
<?php if(isset($bgbulanini)) { ?>
  <script>
  $(document).ready(function(){
    document.getElementById('idbulanini').style.backgroundColor = "#007bff";
    document.getElementById('idabulanini').style.color = "white";
    document.getElementById('idabulanini').style.fontWeight = "bold";
  });
  </script>
<?php } ?>
<?php if(isset($bgtahunini)) { ?>
  <script>
  $(document).ready(function(){
    document.getElementById('idtahunini').style.backgroundColor = "#007bff";
    document.getElementById('idatahunini').style.color = "white";
    document.getElementById('idatahunini').style.fontWeight = "bold";
  });
  </script>
<?php } ?>

<script type="text/javascript">
$(function() {
  document.getElementById('iddaftarsaya').style.backgroundColor = "rgba(255,255,255,.1)";
  document.getElementById('idpdaftarsaya').style.color = "white";  

});
</script>
</body>
</html>