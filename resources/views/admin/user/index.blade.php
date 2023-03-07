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
            <!-- <div class="content"> -->
                <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    </div>
                </nav> -->
                <!-- <a href="{{ route('user/create') }}" class="btn btn-success btn-lg btn-block" role="button"
                    aria-pressed="true">USER</a> -->
                <!-- <table class="table table-bordered">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>NO</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Bidang</th>
                            <th>Seksi</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @//foreach ($penggunaall as $key => $pg)
                            <tr id="pengguna_{//{ $pg->id }}">
                                <td>{//{ $key + 1 }}</td>
                                <td>{//{ $pg->username }}</td>
                                <td>{//{ $pg->nama }}</td>
                                <td>{//{ $pg->ref_bidang['detail_bidang'] }}</td>
                                <td>{//{ $pg->ref_seksi == null ? '-' : $pg->ref_seksi->detail_seksi }}</td>
                                <td>{//{ $pg->level }}</td>
                                <td>
                                    <a data-id="{//{ $pg->id }}" class="btn btn-info"
                                        href="{//{ url('user/edit', $pg->id) }}">Edit</a>
                                    <a class="btn btn-danger" href="{//{ url('user/delete', $pg->id) }}">Delete</a>
                                    <a class="btn btn-warning" href="{//{ url('user/reset', $pg->id) }}">Reset</a>
                                </td>
                            </tr>
                        @//endforeach
                    </tbody>

                </table> -->
            <!-- </div> -->

            <div class="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    </div>
                </nav>
                <a href="{{ route('user/create') }}" class="btn btn-success btn-lg btn-block" role="button"
                    aria-pressed="true" style="margin-bottom: 5px">TAMBAH USER</a>
                 <table class="table table-bordered table-coba" style="width:100%;">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>NO</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Bidang</th>
                            <th>Seksi</th>
                            <th>Level</th>
                            <th>Aksi</th>
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
        $(function() {
            document.getElementById('idUser').style.backgroundColor = "rgba(255,255,255,.1)";
            document.getElementById('idpUser').style.color = "white";

            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('success_edit'))
                toastr.success('{{ Session::get('success_edit') }}');
            @endif

            var table = $('.table-coba').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'username', name: 'username'},
                {data: 'nama', name: 'nama'},
                {data: 'ref_bidang.detail_bidang', render: function(data, row){
                    if(data==null){
                        // console.log(data);
                        return '-';
                    }
                    else{
                        return data;
                    }
                }, name: 'bidang'},
                {data: 'ref_seksi.detail_seksi', render: function(data, row){
                    if(data==null){
                        // console.log(data);
                        return '-';
                    }
                    else{
                        return data;
                    }
                }, name: 'seksi'},
                {data: 'level', name: 'level'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
            });
        });
    </script>
</body>

</html>
