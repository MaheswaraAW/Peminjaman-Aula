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

                    </div>
                </nav>
                <a href="{{ route('user/create') }}" class="btn btn-success btn-lg btn-block" role="button"
                    aria-pressed="true">USER</a>
                <table class="table table-bordered">
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
                        @foreach ($penggunaall as $key => $pg)
                            <tr id="pengguna_{{ $pg->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $pg->username }}</td>
                                <td>{{ $pg->nama }}</td>
                                <td>{{ $pg->ref_bidang->detail_bidang }}</td>
                                <td>{{ $pg->ref_seksi == null ? '-' : $pg->ref_seksi->detail_seksi }}</td>
                                <td>{{ $pg->level }}</td>
                                <td>
                                    <a data-id="{{ $pg->id }}" class="btn btn-info"
                                        href="{{ url('user/edit', $pg->id) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ url('user/delete', $pg->id) }}">Delete</a>
                                    <a class="btn btn-warning" href="{{ url('user/reset', $pg->id) }}">Reset</a>
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
    @include('template.script')
    <script type="text/javascript">
        $(function() {
            document.getElementById('idUser').style.backgroundColor = "rgba(255,255,255,.1)";
            document.getElementById('idpUser').style.color = "white";
        });
    </script>
</body>

</html>
