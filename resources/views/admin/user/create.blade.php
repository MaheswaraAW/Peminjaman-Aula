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
        @include('template.sidebarAdmin')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12 ">
                            <h1 class="m-0 d-flex justify-content-center">Tambah User</h1>
                            <!-- <div class="col-sm-12"> -->
                            @if (@isset($ses_nama))
                                <p align="center">
                                    Username sudah ada
                                </p>
                            @endif
                            <!-- </div> -->
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="container ">
                <form action="{{ route('user/store') }}" method="post">
                    {{ csrf_field() }}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8">
                                <label>Nama</label>
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" name="nama" placeholder="Nama"
                                        required="">
                                </div>
                                <label>Username</label>
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                        required=""></textarea>
                                </div>
                                <label>Password</label>
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" name="password" placeholder="Password"
                                        required=""></textarea>
                                </div>
                                <label>Level</label>
                                <div class="form-group has-feedback col-md-12">
                                    <label class="mr-2">
                                        <input type="radio" name="level" value="0">Admin
                                    </label>
                                    <label class="mr-2">
                                        <input type="radio" name="level" value="1">User
                                    </label>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Bidang</label>
                                    <select name="bidang" id="bidang" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($bidang as $bid)
                                            <option value="{{ $bid->kode_bidang }}">
                                                {{ $bid->detail_bidang }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group has-feedback">
                                    <label>Seksi</label>
                                    <select class="form-control @error('seksi') is-invalid @enderror"
                                        style="width: 100%;" name="seksi" id="id_seksi">
                                    </select>

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- /.content -->
            </div>
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
    <script>
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
        $("#bidang").change(function() {
            var bidang = $(this).val();
            console.log(bidang);
            $.ajax({
                url: "{{ route('get.seksi') }}",
                method: "GET",
                data: {
                    bidang: bidang,
                },
                async: true,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    var html = "";
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html +=
                            "<option value=" +
                            data[i].kode_seksi +
                            ">" +
                            data[i].detail_seksi +
                            "</option>";
                    }
                    $("#id_seksi").html(html);
                },
            });
            return false;
        });
    </script>
</body>

</html>
