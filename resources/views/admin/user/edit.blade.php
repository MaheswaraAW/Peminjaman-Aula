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
                        <div class="col-sm-12">
                            <h1 class="m-0 d-flex justify-content-center">Edit User</h1>
                            @if (@isset($nama))
                                <p align="center"; style="color:red">
                                    {{ $nama }}
                                </p>
                            @endif
                        </div><!-- /.col -->

                        <!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="container ">
                <form action="{{ url('user/update', $penggunaid->id) }}" method="post">
                    {{ csrf_field() }}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8">
                                <label>Nama</label>
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $penggunaid->nama }}" required="">
                                </div>
                                <label>Username</label>
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" name="username"
                                        value="{{ $penggunaid->username }}" required=""></textarea>
                                </div>
                                <!-- <label>Password</label> -->
                                <div id="idpass" class="form-group has-feedback">
                                    <input type="text" class="form-control" name="password"
                                        value="{{ $penggunaid->password }}" required="" readonly></textarea>
                                </div>
                                <label>Password Baru</label>
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="Kosongkan Jika Tidak"
                                        name="passwordbaru"></input>
                                </div>
                                <label>Level</label>
                                <div class="form-group has-feedback col-md-12">
                                    <label class="mr-2">
                                        <input type="radio" name="level" value="0" <?php if ($penggunaid->level == '0') {
                                            echo 'checked';
                                        } ?>>Admin
                                    </label>

                                    <label class="mr-2">
                                        <input type="radio" name="level" value="1" <?php if ($penggunaid->level == '1') {
                                            echo 'checked';
                                        } ?>>User
                                    </label>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Bidang</label>
                                    <select name="bidang" id="bidang" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($bidang as $bid)
                                            <option value="{{ $bid->kode_bidang }}"
                                                {{ $bid->kode_bidang == $penggunaid->bidang ? 'selected' : '' }}>
                                                {{ $bid->detail_bidang }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group has-feedback">
                                    <label>Seksi</label>
                                    <select class="form-control @error('seksi') is-invalid @enderror"
                                        style="width: 100%;" name="seksi" id="seksi">
                                    </select>

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
        get_data_edit();
        $(".kecamatan").change(function() {
            var getkecamatan = $(".kecamatan").val();
            var id_kelurahan = {{ $klinik->kelurahan }};
            $.ajax({
                url: "{{ route('penilai.get-kelurahan') }}",
                method: "GET",
                data: {
                    kecamatan: getkecamatan,
                },
                async: true,
                dataType: "json",
                success: function(data) {
                    $('select[name="kelurahan"]').empty();
                    $.each(data, function(key, value) {
                        if (id_kelurahan == value.id) {
                            $('select[name="kelurahan"]')
                                .append(
                                    '<option value="' +
                                    value.id +
                                    '" selected>' +
                                    value.nama_kelurahan +
                                    "</option>"
                                )
                                .trigger("change");
                        } else {
                            $('select[name="kelurahan"]').append(
                                '<option value="' +
                                value.id +
                                '">' +
                                value.nama_kelurahan +
                                "</option>"
                            );
                        }
                    });
                },
            });
            return false;
        });

        function get_data_edit() {
            var id_klinik = $('[name="klinik"]').val();
            $.ajax({
                url: "{{ route('penilai.get-klinik') }}",
                method: "GET",
                data: {
                    id_klinik: id_klinik,
                },
                async: true,
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    $.each(data, function(i, item) {
                        $('[name="klinik"]').val(data[i].id_klinik);
                        $('[name="kecamatan"]')
                            .val(data[i].kecamatan)
                            .trigger("change");
                        $('[name="kelurahan"]')
                            .val(data[i].kelurahan)
                            .trigger("change");
                    });
                },
            });
        }
    </script>
    <script type="text/javascript">
        $(function() {
            document.getElementById('idpass').style.display = "none";
            document.getElementById('idpass').style.visibility = "hidden";
        });
    </script>
</body>

</html>
