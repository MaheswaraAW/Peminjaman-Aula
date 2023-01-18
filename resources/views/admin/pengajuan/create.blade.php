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
                            <h1 class="m-0 d-flex justify-content-center">Tambah Pengajuan</h1>
                            <!-- <div class="col-sm-12"> -->
                            @if (@isset($ses_jam))
                                <p align="center">
                                    jam sudah dipakai {{ $ses_jam }}
                                </p>
                            @endif
                            <!-- </div> -->
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="container d-flex justify-content-center">
                <form action="{{ route('pengajuan/simpan') }}" method="post">
                    {{ csrf_field() }}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Acara</label>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" name="acara" placeholder="Acara"
                                    required="">
                            </div>

                            <label>Tanggal</label>
                            <div class="form-group has-feedback">
                                <input type="date" class="form-control" name="tanggal" id="tanggal" required=""
                                    onchange="cek()">
                            </div>
                            <div class="form=group">
                                <div class="row form-group">
                                    <div class=column>
                                        <label class="ml-2">Jam Mulai</label>
                                        <div class="col input-group date" id="jam_mulai" data-target-input="nearest"
                                            onchange="cek()">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#jam_mulai" name="jam_mulai" id="jam_m" />
                                            <div class="input-group-append" data-target="#jam_mulai"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="bi bi-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <label class="ml-2">Jam Selesai</label>
                                        <div class="col input-group date" id="jam_selesai" data-target-input="nearest"
                                            onchange="cek()">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#jam_selesai" name="jam_selesai" id="jam_s" />
                                            <div class="input-group-append" data-target="#jam_selesai"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="bi bi-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback col-md-12">
                                <label class="mr-2" id="AulaA">
                                    <input type="checkbox" name="tempat[]" value="Aula A">Aula A
                                </label>

                                <label class="mr-2" id="AulaB">
                                    <input type="checkbox" name="tempat[]" value="Aula B">Aula B
                                </label>

                                <label class="mr-2" id="AulaC">
                                    <input type="checkbox" name="tempat[]" value="Aula C">Aula C
                                </label>

                                <!-- <div> -->
                                <label id="penuh" style="visibility:hidden">Aula Penuh</label>
                                <!-- </div> -->
                            </div>


                            <label>Bidang</label>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" name="bidang" placeholder="Bidang"
                                    required="">
                            </div>
                            <label>Seksi</label>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" name="seksi" placeholder="Seksi"
                                    required="">
                            </div>
                            <div class="form-group has-feedback">
                                <input type="hidden" class="form-control" name="pemesan" placeholder="Pemesan"
                                    required="" value="{{ $pengguna->username }}">
                            </div>
                            <label>Keterangan</label>
                            <div class="form-group has-feedback">
                                <textarea type="text" class="form-control" name="keterangan" placeholder="Keterangan" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"
        integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"
        integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg=="
        crossorigin="anonymous" />

    <script type="text/javascript">
        function cek() {
            // console.log('jam');
            var tanggal = $('#tanggal').val();
            var jam_m = $('#jam_m').val();
            var jam_s = $('#jam_s').val();

            if (jam_s !== '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('pengajuan.cektempat') }}',
                    type: 'post',
                    data: {
                        tanggal: tanggal,
                        jam_m: jam_m,
                        jam_s: jam_s,
                    },
                    success: function(data) {
                        console.log(data);
                        document.getElementById('AulaA').style.visibility = "visible";
                        document.getElementById('AulaB').style.visibility = "visible";
                        document.getElementById('AulaC').style.visibility = "visible";
                        document.getElementById('penuh').style.visibility = "hidden";

                        data.map(function(data) {
                            if (data.tempat == "Aula ABC") {
                                AulaA = "ada";
                                AulaB = "ada";
                                AulaC = "ada";
                                return data;

                                // console.log(data.tempat);
                            }
                            if (data.tempat == "Aula AB") {
                                AulaA = "ada";
                                AulaB = "ada";

                                // AulaC="";
                                if (AulaC != "") {
                                    AulaC = "ada";
                                } else {
                                    AulaC = "";
                                }
                                return data;
                            }
                            if (data.tempat == "Aula BC") {
                                AulaB = "ada";
                                AulaC = "ada";

                                if (AulaA != "") {
                                    AulaA = "ada";
                                } else {
                                    AulaA = "";
                                }

                                return data;
                            }
                            if (data.tempat == "Aula A") {
                                AulaA = "ada";
                                return data;
                            }
                            if (data.tempat == "Aula B") {

                                // console.log(data.tempat);
                                AulaB = "ada";

                                return data;
                            }
                            if (data.tempat == "Aula C") {
                                AulaC = "ada";
                                return data;
                            } else {
                                return null;
                            }


                        });

                        if (AulaA != "") {
                            console.log('ceka')
                            document.getElementById('AulaA').style.visibility = "hidden";
                        }
                        if (AulaB != "") {
                            console.log('cekb')
                            document.getElementById('AulaB').style.visibility = "hidden";
                        }
                        if (AulaC != "") {
                            console.log('cekc')
                            document.getElementById('AulaC').style.visibility = "hidden";
                            // if(AulaA!=""){
                            //   document.getElementById('AulaA').style.visibility="hidden";
                            // }
                            // if(AulaB!=""){
                            //   document.getElementById('AulaB').style.visibility="hidden";
                            // }
                            if (AulaA != "" && AulaB != "" && AulaC != "")
                                document.getElementById('penuh').style.visibility = "visible";
                        }
                        AulaA = "";
                        AulaB = "";
                        AulaC = "";

                    },
                    error: function(response) {

                    }
                });
            }
        }

        $(function() {
            $('#jam_mulai').datetimepicker({
                // format: 'LT'
                format: 'HH:mm'
            });

            $('#jam_selesai').datetimepicker({
                // format: 'LT'
                format: 'HH:mm'
            });


        });
    </script>
</body>

</html>
