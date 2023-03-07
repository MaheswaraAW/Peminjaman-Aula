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
                                <a class="nav-link" href="{{ url('pengajuan/daftarsemua/semua') }}"
                                    id="idasemua">SEMUA</a>
                            </li>
                            <li class="nav-item" id="idhariini">
                                <a class="nav-link" href="{{ url('pengajuan/daftarsemua/hariini') }}"
                                    id="idahariini">HARI INI</a>
                            </li>
                            <li class="nav-item" id="idbulanini">
                                <a class="nav-link" href="{{ url('pengajuan/daftarsemua/bulanini') }}"
                                    id="idabulanini">BULAN INI</a>
                            </li>
                            <li class="nav-item" id="idtahunini">
                                <a class="nav-link" href="{{ url('pengajuan/daftarsemua/tahunini') }}"
                                    id="idatahunini">TAHUN INI</a>
                            </li>
                        </ul>

                    </div>
                </nav>
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
                            <th>PEMOHON</th>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>

                    @//foreach ($pengajuan as $key => $pj)
                        <tr>
                            <td>{//{ $key + 1 }}</td>
                            <td>{//{ $pj->tanggal }}</td>
                            <td>{//{ $pj->jam_m . '-' . $pj->jam_s }}</td>
                            <td>{//{ $pj->acara }}</td>
                            <td>{//{ $pj->tempat }}</td>
                            <td>{//{ $pj->ref_bidang->detail_bidang }}</td>
                            <td>{//{ $pj->ref_seksi->detail_seksi }}</td>
                            <td>{//{ ucwords(ucwords($pj->pemesan)) }}</td>
                            <td>{//{ $pj->keterangan }}</td>
                        </tr>
                    @//endforeach

                </table> -->
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
                            <th>PEMOHON</th>
                            <th>KETERANGAN</th>
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
    <?php if(isset($bgsemua)) { ?>
    <script>
        $(document).ready(function() {
            document.getElementById('idsemua').style.backgroundColor = "#007bff";
            document.getElementById('idasemua').style.color = "white";
            document.getElementById('idasemua').style.fontWeight = "bold";

            var table = $('.table-coba').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuan/daftarsemua/semua') }}",
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
                ]
                });
        });
    </script>
    <?php } ?>
    <?php if(isset($bghariini)) { ?>
    <script>
        $(document).ready(function() {
            document.getElementById('idhariini').style.backgroundColor = "#007bff";
            document.getElementById('idahariini').style.color = "white";
            document.getElementById('idahariini').style.fontWeight = "bold";

            var table = $('.table-coba').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuan/daftarsemua/hariini') }}",
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
                ]
                });
        });
    </script>
    <?php } ?>
    <?php if(isset($bgbulanini)) { ?>
    <script>
        $(document).ready(function() {
            document.getElementById('idbulanini').style.backgroundColor = "#007bff";
            document.getElementById('idabulanini').style.color = "white";
            document.getElementById('idabulanini').style.fontWeight = "bold";

            var table = $('.table-coba').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuan/daftarsemua/bulanini') }}",
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
                ]
                });
        });
    </script>
    <?php } ?>
    <?php if(isset($bgtahunini)) { ?>
    <script>
        $(document).ready(function() {
            document.getElementById('idtahunini').style.backgroundColor = "#007bff";
            document.getElementById('idatahunini').style.color = "white";
            document.getElementById('idatahunini').style.fontWeight = "bold";

            var table = $('.table-coba').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuan/daftarsemua/tahunini') }}",
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
                ]
                });
        });
    </script>
    <?php } ?>

    <script type="text/javascript">
        $(function() {
            document.getElementById('iddaftarsemua').style.backgroundColor = "rgba(255,255,255,.1)";
            document.getElementById('idpdaftarsemua').style.color = "white";
        });
    </script>
</body>

</html>
