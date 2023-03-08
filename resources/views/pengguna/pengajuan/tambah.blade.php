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
        @include('template.sidebarPengguna')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12 ">
                            <h1 class="m-0 d-flex justify-content-center">Tambah Pengajuan</h1>
                            <!-- <div class="col-sm-12"> -->

                            <!-- </div> -->
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="container">
                <form name="form_pengajuan" action="{{ route('pengajuan/simpan') }}" method="post"
                    onsubmit="return validasi()">
                    {{ csrf_field() }}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group has-feedback">
                                    <label>Acara</label>
                                    <input type="text" class="form-control" name="acara" placeholder="Acara"
                                        required="">
                                </div>

                                <div class="form-group has-feedback">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal"
                                        required="" onchange="cek()">
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
                                            <div class="col input-group date" id="jam_selesai"
                                                data-target-input="nearest" onchange="cek()">
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
                                <div style=" display:flex; justify-content: center;">
                                    <label id="penuh" style="visibility:hidden; color:red">Aula Penuh</label>
                                </div>
                                <div class="form-group has-feedback col-md-12">
                                    <label id="pilih" style="visibility:hidden">Silahkan Pilih</label>
                                    <label class="mr-2" id="AulaA">
                                        <input type="checkbox" name="tempat[]" value="Aula A" id="IAulaA">Aula A
                                    </label>

                                    <label class="mr-2" id="AulaB">
                                        <input type="checkbox" name="tempat[]" value="Aula B" id="IAulaB">Aula B
                                    </label>

                                    <label class="mr-2" id="AulaC">
                                        <input type="checkbox" name="tempat[]" value="Aula C" id="IAulaC">Aula C
                                    </label>

                                    <label class="mr-2" id="RuangRapatLt9">
                                        <input type="checkbox" name="tempat[]" value="Ruang Rapat Lt 9"
                                            id="ILantai9">Ruang Rapat Lt 9
                                    </label>

                                </div>



                                @if (empty($pengguna->seksi))
                                    <div class="form-group has-feedback">
                                        <label>Bidang</label>


                                        <select name="bidang" id="bidang" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($bidang as $bid)
                                                <option value="{{ $bid->detail_bidang }}"
                                                    {{ $bid->kode_bidang == $pengguna->bidang ? '' : 'disabled' }}>
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
                                @else
                                    <div class="form-group has-feedback">
                                        <label>Bidang</label>
                                        <select name="bidang" class="form-control">
                                            @foreach ($bidang as $bid)
                                                <option value="{{ $bid->detail_bidang }}"
                                                    {{ $bid->kode_bidang == $pengguna->bidang ? 'selected' : 'disabled' }}>
                                                    {{ $bid->detail_bidang }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Seksi</label>
                                        <select class="form-control @error('seksi') is-invalid @enderror"
                                            style="width: 100%;" name="seksi">
                                            @foreach ($seksi as $sek)
                                                <option value="{{ $sek->detail_seksi }}"
                                                    {{ $sek->kode_seksi == $pengguna->seksi ? 'selected' : 'disabled' }}>
                                                    {{ $sek->detail_seksi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif


                                <div class="form-group has-feedback">
                                    <input type="hidden" class="form-control" name="pemesan" placeholder="Pemesan"
                                        required="" value="{{ $pengguna->username }}">
                                </div>
                                <label>Keterangan</label>
                                <div class="form-group has-feedback">
                                    <textarea type="text" class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
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

    <script type="text/javascript">
        function validasi() {
            // console.log("validasi");
            var valid_jam_mulai = document.form_pengajuan.jam_mulai.value;
            // console.log(valid_jam_mulai);
            if (valid_jam_mulai == "") {
                document.form_pengajuan.jam_mulai.focus();
                return false;
            }

            var valid_jam_selesai = document.form_pengajuan.jam_selesai.value;
            // console.log(validjam);
            if (valid_jam_selesai == "") {
                document.form_pengajuan.jam_selesai.focus();
                return false;
            }

            //validasi aula
            var validaula = false;
            if (document.getElementById("IAulaA").checked) {
                validaula = true;
            } else if (document.getElementById("IAulaB").checked) {
                validaula = true;
            } else if (document.getElementById("IAulaC").checked) {
                validaula = true;
            } else if (document.getElementById("ILantai9").checked) {
                validaula = true;
            }

            if (validaula == false) {
                document.getElementById('pilih').style.visibility = "visible";
                document.getElementById('pilih').style.color = "red";
                return false;
            }

            //validasi bidang dan seksi
            var validbidang = document.form_pengajuan.bidang.value;
            if (validbidang == "PilihBidang") {
                document.form_pengajuan.bidang.focus();
                return false;
            }

            var validseksi = document.form_pengajuan.seksi.value;
            if (validseksi == "PilihSeksi") {
                document.form_pengajuan.seksi.focus();
                return false;
            }

            return true;

        }

        function ocbidang(bidang) {
            // console.log(bidang);

            $("#seksi option[value='-']").hide();
            $("#seksi option[value='Pilih']").show();
            // $("#seksi").add(new Option('Pilih'));

            $("#seksi option[value='Seksi Kesehatan Ibu dan Anak']").hide();
            $("#seksi option[value='Seksi Kesehatan Lingkungan dan Promosi Kesehatan']").hide();
            $("#seksi option[value='Seksi Pemberdayaan Masyarakat dan Gizi']").hide();

            $("#seksi option[value='Seksi P2 Tular Vektor dan Zoonotik']").hide();
            $("#seksi option[value='Seksi P2 Tidak Menular dan Surveilans']").hide();
            $("#seksi option[value='Seksi P2 Penyakit Menular Langsung']").hide();

            $("#seksi option[value='Seksi Kefarmasian dan Perbekalan Kesehatan']").hide();
            $("#seksi option[value='Seksi Sumber Daya Manusia Kesehatan']").hide();
            $("#seksi option[value='Seksi Informasi dan Pengendalian Sarana Kesehatan']").hide();

            $("#seksi option[value='Sub bag Perencanaan dan Evaluasi']").hide();
            $("#seksi option[value='Sub bag Keuangan dan Aset']").hide();
            $("#seksi option[value='Sub bag Umum Kepegawaian']").hide();

            $("#seksi option[value='Seksi Pelayanan Kesehatan Primer dan Tradisional']").hide();
            $("#seksi option[value='Seksi Pelayanan Kesehatan Rujukan']").hide();
            $("#seksi option[value='Seksi Jaminan Kesehatan dan Kemitraan']").hide();


            if (bidang == 'Kepala Dinas') {
                $("#seksi option[value='-']").show();
                $("#seksi option[value='Pilih']").hide();

                document.getElementById("seksi").selectedIndex = 1;
            }
            if (bidang == 'Kesehatan Masyarakat') {
                $("#seksi option[value='Seksi Kesehatan Ibu dan Anak']").show();
                $("#seksi option[value='Seksi Kesehatan Lingkungan dan Promosi Kesehatan']").show();
                $("#seksi option[value='Seksi Pemberdayaan Masyarakat dan Gizi']").show();
            }
            if (bidang == 'Pencegahan Pemberantasan Penyakit') {
                $("#seksi option[value='Seksi P2 Tular Vektor dan Zoonotik']").show();
                $("#seksi option[value='Seksi P2 Tidak Menular dan Surveilans']").show();
                $("#seksi option[value='Seksi P2 Penyakit Menular Langsung']").show();
                // console.log('pilih');
            }
            if (bidang == 'Sumber Daya Kesehatan') {
                $("#seksi option[value='Seksi Kefarmasian dan Perbekalan Kesehatan']").show();
                $("#seksi option[value='Seksi Sumber Daya Manusia Kesehatan']").show();
                $("#seksi option[value='Seksi Informasi dan Pengendalian Sarana Kesehatan']").show();
            }
            if (bidang == 'Sekretariat') {
                $("#seksi option[value='Sub bag Perencanaan dan Evaluasi']").show();
                $("#seksi option[value='Sub bag Keuangan dan Aset']").show();
                $("#seksi option[value='Sub bag Umum Kepegawaian']").show();
            }
            if (bidang == 'Pelayanan Kesehatan') {
                $("#seksi option[value='Seksi Pelayanan Kesehatan Primer dan Tradisional']").show();
                $("#seksi option[value='Seksi Pelayanan Kesehatan Rujukan']").show();
                $("#seksi option[value='Seksi Jaminan Kesehatan dan Kemitraan']").show();
            }
        }

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
                        document.getElementById('RuangRapatLt9').style.visibility = "visible";
                        document.getElementById('penuh').style.visibility = "hidden";

                        data.map(function(data) {
                            if (data.tempat == "Ruang Rapat Lt 9") {
                                RuangRapatLt9 = "ada";

                                document.getElementById('RuangRapatLt9').style.visibility = "hidden";

                                return data;

                                // console.log(data.tempat);
                            }

                            if (data.tempat == "Aula A B C & Ruang Rapat Lt 9") {
                                AulaA = "ada";
                                AulaB = "ada";
                                AulaC = "ada";
                                RuangRapatLt9 = "ada";

                                document.getElementById('AulaA').style.visibility = "hidden";
                                document.getElementById('AulaB').style.visibility = "hidden";
                                document.getElementById('AulaC').style.visibility = "hidden";
                                document.getElementById('RuangRapatLt9').style.visibility = "hidden";

                                return data;

                                // console.log(data.tempat);
                            }
                            // if (data.tempat == "Aula ABC") {
                            if (data.tempat == "Aula A B C") {
                                AulaA = "ada";
                                AulaB = "ada";
                                AulaC = "ada";

                                document.getElementById('AulaA').style.visibility = "hidden";
                                document.getElementById('AulaB').style.visibility = "hidden";
                                document.getElementById('AulaC').style.visibility = "hidden";
                                return data;

                                // console.log(data.tempat);
                            }

                            if (data.tempat == "Aula A B & Ruang Rapat Lt 9") {
                                AulaA = "ada";
                                AulaB = "ada";
                                RuangRapatLt9 = "ada";

                                document.getElementById('AulaA').style.visibility = "hidden";
                                document.getElementById('AulaB').style.visibility = "hidden";
                                document.getElementById('RuangRapatLt9').style.visibility = "hidden";

                                return data;

                                // console.log(data.tempat);
                            }
                            // if (data.tempat == "Aula AB") {
                            if (data.tempat == "Aula A B") {
                                AulaA = "ada";
                                AulaB = "ada";
                                document.getElementById('AulaA').style.visibility = "hidden";
                                document.getElementById('AulaB').style.visibility = "hidden";

                                // AulaC="";
                                if (AulaC != "") {
                                    AulaC = "ada";
                                    document.getElementById('AulaC').style.visibility = "hidden";
                                } else {
                                    AulaC = "";
                                }
                                return data;
                            }

                            if (data.tempat == "Aula B C & Ruang Rapat Lt 9") {
                                AulaB = "ada";
                                AulaC = "ada";
                                RuangRapatLt9 = "ada";
                                document.getElementById('AulaB').style.visibility = "hidden";
                                document.getElementById('AulaC').style.visibility = "hidden";
                                document.getElementById('RuangRapatLt9').style.visibility = "hidden";

                                return data;

                                // console.log(data.tempat);
                            }

                            // if (data.tempat == "Aula BC") {
                            if (data.tempat == "Aula B C") {
                                AulaB = "ada";
                                AulaC = "ada";
                                document.getElementById('AulaB').style.visibility = "hidden";
                                document.getElementById('AulaC').style.visibility = "hidden";

                                if (AulaA != "") {
                                    AulaA = "ada";
                                    document.getElementById('AulaA').style.visibility = "hidden";
                                } else {
                                    AulaA = "";
                                }

                                return data;
                            }

                            if (data.tempat == "Aula A & Ruang Rapat Lt 9") {
                                AulaA = "ada";
                                RuangRapatLt9 = "ada";
                                document.getElementById('AulaA').style.visibility = "hidden";
                                document.getElementById('RuangRapatLt9').style.visibility = "hidden";

                                return data;

                                // console.log(data.tempat);
                            }

                            if (data.tempat == "Aula A") {
                                AulaA = "ada";
                                document.getElementById('AulaA').style.visibility = "hidden";

                                return data;
                            }

                            if (data.tempat == "Aula B & Ruang Rapat Lt 9") {
                                AulaB = "ada";
                                RuangRapatLt9 = "ada";
                                document.getElementById('AulaB').style.visibility = "hidden";
                                document.getElementById('RuangRapatLt9').style.visibility = "hidden";

                                return data;

                                // console.log(data.tempat);
                            }

                            if (data.tempat == "Aula B") {

                                // console.log(data.tempat);
                                AulaB = "ada";
                                document.getElementById('AulaB').style.visibility = "hidden";

                                return data;
                            }

                            if (data.tempat == "Aula C & Ruang Rapat Lt 9") {
                                AulaC = "ada";
                                RuangRapatLt9 = "ada";
                                document.getElementById('AulaC').style.visibility = "hidden";
                                document.getElementById('RuangRapatLt9').style.visibility = "hidden";

                                return data;

                                // console.log(data.tempat);
                            }

                            if (data.tempat == "Aula C") {
                                AulaC = "ada";
                                document.getElementById('AulaC').style.visibility = "hidden";
                                return data;
                            } else {
                                return null;
                            }


                        });

                        // if (AulaA == "ada") {
                        //     // console.log('ceka')
                        //     document.getElementById('AulaA').style.visibility = "hidden";
                        // }
                        // if (AulaB == "ada") {
                        //     // console.log('cekb')
                        //     document.getElementById('AulaB').style.visibility = "hidden";
                        // }
                        // if (AulaC == "ada") {
                        //     // console.log('cekc')
                        //     document.getElementById('AulaC').style.visibility = "hidden";
                        // }
                        // if (RuangRapatLt9 == "ada") {
                        //     document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                        // }
                        if (AulaA == "ada" && AulaB == "ada" && AulaC == "ada" && RuangRapatLt9 == "ada") {
                            document.getElementById('penuh').style.visibility = "visible";
                        }
                        AulaA = "";
                        AulaB = "";
                        AulaC = "";
                        RuangRapatLt9 = "";

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

            document.getElementById('idtambah').style.backgroundColor = "rgba(255,255,255,.1)";
            document.getElementById('idptambah').style.color = "white";

        });
    </script>

</body>

</html>
