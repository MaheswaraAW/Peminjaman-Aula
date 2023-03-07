<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    @include('template.head')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script defer src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
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
                            <li class="nav-item" id="idsemua">
                                <a class="nav-link" href="{{ url('pengajuan/semua') }}" id="idasemua">SEMUA</a>
                            </li>
                            <!-- <li class="nav-item" id="idhariini">
                                <a class="nav-link" href="{{ url('pengajuan/hariini') }}" id="idahariini">HARI INI</a>
                            </li> -->
                            <li class="nav-item" id="idhariini">
                                <a class="nav-link" href="{{ url('pengajuan') }}" id="idahariini">HARI INI</a>
                            </li>
                            <li class="nav-item" id="idbulanini">
                                <a class="nav-link" href="{{ url('pengajuan/bulanini') }}" id="idabulanini">BULAN
                                    INI</a>
                            </li>
                            <li class="nav-item" id="idtahunini">
                                <a class="nav-link" href="{{ url('pengajuan/tahunini') }}" id="idatahunini">TAHUN
                                    INI</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- <a href="{{ route('pengajuan/create') }}" class="btn btn-success btn-lg btn-block" role="button"
                    aria-pressed="true">PENGAJUAN</a> -->
                <!-- <table class="table table-bordered">
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

                        @//foreach ($pengajuan as $key => $pj)
                            <tr>
                                <td>{//{ $key + 1 }}</td>
                                <td>{//{ $pj->tanggal }}</td>
                                <td>{//{ $pj->jam_m . '-' . $pj->jam_s }}</td>
                                <td>{//{ $pj->acara }}</td>
                                <td>{//{ $pj->tempat }}</td>
                                <td>{//{ $pj->ref_bidang->detail_bidang }}</td>
                                <td>{//{ $pj->ref_bidang['detail_bidang'] }}</td>
                                <td>{//{ $pj->ref_seksi['detail_seksi'] }}</td>
                                <td>{//{ ucwords($pj->pemesan) }}</td>
                                <td>{//{ $pj->keterangan }}</td>
                                <td>
                                    <a href="{//{ url('pengajuan/edit', $pj->id) }}"
                                        class="btn btn-info btn-md"></i>Edit</a>
                                    <a href="{//{ url('delete_pesan', $pj->id) }}"
                                        class="btn btn-danger btn-md"></i>Delete</a>
                                </td>
                            </tr>
                        @//endforeach
                    </tbody>

                </table> -->

                <a href="{{ route('pengajuan/create') }}" class="btn btn-success btn-lg btn-block" role="button"
                    aria-pressed="true" style="margin-bottom: 5px">PENGAJUAN</a>
                <table class="table table-bordered table-coba">
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

    @include('template.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('success_edit'))
                toastr.success('{{ Session::get('success_edit') }}');
            @endif

            var ur=window.location.href;
            var or=window.location.origin;
            
            if(ur===or+'/pengajuan'||ur===or+'/pengajuan/hariini'){
                var table = $('.table-coba').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuan') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'tanggal', name: 'username'},
                    {data: {jam_m:"jam_m", jam_s:"jam_s"}, render: function(data, row){
                            return data.jam_m+'-'+data.jam_s;
                        }
                    , name: 'jam'},
                    {data: 'acara', name: 'acara'},
                    {data: 'tempat', name: 'tempat'},
                    {data: 'bidang', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'bidang'},
                    {data: 'seksi', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'seksi'},
                    {data: 'pemesan', name: 'pemesan'},
                    {data: 'keterangan', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'keterangan'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
                });
            }
            if(ur==or+'/pengajuan/bulanini'){
                var table = $('.table-coba').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuan/bulanini') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'tanggal', name: 'username'},
                    {data: {jam_m:"jam_m", jam_s:"jam_s"}, render: function(data, row){
                            return data.jam_m+'-'+data.jam_s;
                        }
                    , name: 'jam'},
                    {data: 'acara', name: 'acara'},
                    {data: 'tempat', name: 'tempat'},
                    {data: 'bidang', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'bidang'},
                    {data: 'seksi', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'seksi'},
                    {data: 'pemesan', name: 'pemesan'},
                    {data: 'keterangan', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'keterangan'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
                });       
            }
            if(ur==or+'/pengajuan/tahunini'){
                var table = $('.table-coba').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuan/tahunini') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'tanggal', name: 'username'},
                    {data: {jam_m:"jam_m", jam_s:"jam_s"}, render: function(data, row){
                            return data.jam_m+'-'+data.jam_s;
                        }
                    , name: 'jam'},
                    {data: 'acara', name: 'acara'},
                    {data: 'tempat', name: 'tempat'},
                    {data: 'bidang', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'bidang'},
                    {data: 'seksi', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'seksi'},
                    {data: 'pemesan', name: 'pemesan'},
                    {data: 'keterangan', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'keterangan'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
                });       
            }
            if(ur==or+'/pengajuan/semua'){
                var table = $('.table-coba').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuan/semua') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'tanggal', name: 'username'},
                    {data: {jam_m:"jam_m", jam_s:"jam_s"}, render: function(data, row){
                            return data.jam_m+'-'+data.jam_s;
                        }
                    , name: 'jam'},
                    {data: 'acara', name: 'acara'},
                    {data: 'tempat', name: 'tempat'},
                    {data: 'bidang', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'bidang'},
                    {data: 'seksi', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'seksi'},
                    {data: 'pemesan', name: 'pemesan'},
                    {data: 'keterangan', render: function(data, row){
                        if(data==null){
                            // console.log(data);
                            return '-';
                        }
                        else{
                            return data;
                        }
                    }, name: 'keterangan'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
                });       
            }


            
        });
    </script>
    <?php if(isset($bgsemua)) { ?>
    <script>
        $(document).ready(function() {
            document.getElementById('idsemua').style.backgroundColor = "#007bff";
            document.getElementById('idasemua').style.color = "white";
            document.getElementById('idasemua').style.fontWeight = "bold";
        });
    </script>
    <?php } ?>
    <?php if(isset($bghariini)) { ?>
    <script>
        $(document).ready(function() {
            document.getElementById('idhariini').style.backgroundColor = "#007bff";
            document.getElementById('idahariini').style.color = "white";
            document.getElementById('idahariini').style.fontWeight = "bold";
        });
    </script>
    <?php } ?>
    <?php if(isset($bgbulanini)) { ?>
    <script>
        $(document).ready(function() {
            document.getElementById('idbulanini').style.backgroundColor = "#007bff";
            document.getElementById('idabulanini').style.color = "white";
            document.getElementById('idabulanini').style.fontWeight = "bold";
        });
    </script>
    <?php } ?>
    <?php if(isset($bgtahunini)) { ?>
    <script>
        $(document).ready(function() {
            document.getElementById('idtahunini').style.backgroundColor = "#007bff";
            document.getElementById('idatahunini').style.color = "white";
            document.getElementById('idatahunini').style.fontWeight = "bold";
        });
    </script>
    <?php } ?>
    <script type="text/javascript">
        $(document).ready(function() {
            document.getElementById('idPengajuan').style.backgroundColor = "rgba(255,255,255,.1)";
            document.getElementById('idpPengajuan').style.color = "white";
        });
    </script>
</body>

</html>
