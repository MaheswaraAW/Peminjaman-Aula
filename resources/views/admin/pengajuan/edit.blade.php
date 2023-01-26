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
                            <h1 class="m-0 d-flex justify-content-center">Edit Pengajuan</h1>
                        </div><!-- /.col -->

                        <!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="container d-flex justify-content-center">
                <form name= "form_pengajuan_edit" action="{{ url('pengajuan/update', $pengajuan->id) }}" method="post" onsubmit="return validasi()">
                    {{ csrf_field() }}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" class="form-control" name="id" placeholder="id" required=""
                                value="{{ $pengajuan->id }}">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" name="acara" required=""
                                    value="{{ $pengajuan->acara }}">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="tanggal" required=""
                                    value="{{ $tgl2 }}" id="tanggal" onchange="cek()">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form=group">
                                <div class="row form-group">
                                    <div class=column>
                                        <label class="ml-2">Jam Mulai</label>
                                        <div class="col input-group date" id="jam_mulai" data-target-input="nearest"
                                            onchange="cek()">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#jam_mulai" name="jam_mulai" id="jam_m"
                                                value="{{ $pengajuan->jam_m }}" />
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
                                                data-target="#jam_selesai" name="jam_selesai" id="jam_s"
                                                value="{{ $pengajuan->jam_s }}" />
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
                                    <input type="checkbox" name="tempat[]" value="Ruang Rapat Lt 9" id="ILantai9">Ruang Rapat Lt 9
                                </label>
                            </div>
                            <div class="form-group has-feedback">
                                <!-- <input type="text" class="form-control" name="bidang" required=""
                                    value="{{ $pengajuan->bidang }}"> -->
                                <select name="bidang" id="bidang" onchange="ocbidang(this.value)">
                                    <option value="PilihBidang">Pilih</option>
                                    <option value="Kepala Dinas">Kepala Dinas</option>
                                    <option value="Kesehatan Masyarakat">Kesehatan Masyarakat</option>
                                    <option value="Pencegahan Pemberantasan Penyakit">Pencegahan Pemberantasan Penyakit</option>
                                    <option value="Sumber Daya Kesehatan">Sumber Daya Kesehatan</option>
                                    <option value="Sekretariat">Sekretariat</option>
                                    <option value="Pelayanan Kesehatan">Pelayanan Kesehatan</option>
                                </select>
                            </div>
                            <div class="form-group has-feedback">
                                <!-- <input type="text" class="form-control" name="seksi" required=""
                                    value="{{ $pengajuan->seksi }}"> -->
                                <select name="seksi" id="seksi">
                                    <option value="PilihSeksi">Pilih</option>
                                    <!-- kadin -->
                                    <option value="-">-</option>
                                    <!-- kesmas -->
                                    <option value="Seksi Kesehatan Ibu dan Anak">Seksi Kesehatan Ibu dan Anak</option>
                                    <option value="Seksi Kesehatan Lingkungan dan Promosi Kesehatan">Seksi Kesehatan Lingkungan dan Promosi Kesehatan</option>
                                    <option value="Seksi Pemberdayaan Masyarakat dan Gizi">Seksi Pemberdayaan Masyarakat dan Gizi</option>
                                    <!-- Pencegahan Pemberantasan Penyakit -->
                                    <option value="Seksi P2 Tular Vektor dan Zoonotik">Seksi P2 Tular Vektor dan Zoonotik</option>
                                    <option value="Seksi P2 Tidak Menular dan Surveilans">Seksi P2 Tidak Menular dan Surveilans</option>
                                    <option value="Seksi P2 Penyakit Menular Langsung">Seksi P2 Penyakit Menular Langsung</option>
                                    <!-- Sumber Daya Kesehatan -->
                                    <option value="Seksi Kefarmasian dan Perbekalan Kesehatan">Seksi Kefarmasian dan Perbekalan Kesehatan</option>
                                    <option value="Seksi Sumber Daya Manusia Kesehatan">Seksi Sumber Daya Manusia Kesehatan</option>
                                    <option value="Seksi Informasi dan Pengendalian Sarana Kesehatan">Seksi Informasi dan Pengendalian Sarana Kesehatan</option>
                                    <!-- sekretariat -->
                                    <option value="Sub bag Perencanaan dan Evaluasi">Sub bag Perencanaan dan Evaluasi</option>
                                    <option value="Sub bag Keuangan dan Aset">Sub bag Keuangan dan Aset</option>
                                    <option value="Sub bag Umum Kepegawaian">Sub bag Umum Kepegawaian</option>
                                    <!-- pelayanan kesehatan -->
                                    <option value="Seksi Pelayanan Kesehatan Primer dan Tradisional">Seksi Pelayanan Kesehatan Primer dan Tradisional</option>
                                    <option value="Seksi Pelayanan Kesehatan Rujukan">Seksi Pelayanan Kesehatan Rujukan</option>
                                    <option value="Seksi Jaminan Kesehatan dan Kemitraan">Seksi Jaminan Kesehatan dan Kemitraan</option>
                                </select>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="hidden" class="form-control" name="pemesan" required=""
                                    value="{{ $pengajuan->pemesan }}">
                            </div>
                            <div class="form-group has-feedback">
                                <textarea type="text" class="form-control" name="keterangan">{{ $pengajuan->keterangan }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
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
function validasi(){
        // console.log("validasi");
        var valid_jam_mulai = document.form_pengajuan_edit.jam_mulai.value;
        // console.log(valid_jam_mulai);
        if(valid_jam_mulai==""){
            document.form_pengajuan_edit.jam_mulai.focus();
            return false;
        }

        var valid_jam_selesai = document.form_pengajuan_edit.jam_selesai.value;
        // console.log(validjam);
        if(valid_jam_selesai==""){
            document.form_pengajuan_edit.jam_selesai.focus();
            return false;
        }

        //validasi aula
        var validaula = false;
        if(document.getElementById("IAulaA").checked){
            validaula = true;
        }
        else if(document.getElementById("IAulaB").checked){
            validaula = true;
        }
        else if(document.getElementById("IAulaC").checked){
            validaula = true;
        }
        else if(document.getElementById("ILantai9").checked){
        validaula = true;
        }

        if(validaula==false){
            document.getElementById('pilih').style.visibility = "visible";
            document.getElementById('pilih').style.color = "red";
            return false;
        }

        //validasi bidang dan seksi
        var validbidang = document.form_pengajuan_edit.bidang.value;
        if(validbidang=="PilihBidang"){
            document.form_pengajuan_edit.bidang.focus();
            return false;
        }

        var validseksi = document.form_pengajuan_edit.seksi.value;
        if(validseksi=="PilihSeksi"){
            document.form_pengajuan_edit.seksi.focus();
            return false;
        }

        return true;         

    }
function editbidang(){
    var ebidang="<?php echo $pengajuan->bidang; ?>";
    // console.log(vbidang);

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


    if(ebidang=='Kepala Dinas'){
        $("#seksi option[value='-']").show();
        $("#seksi option[value='Pilih']").hide();
        
        document.getElementById("seksi").selectedIndex=1;
    }
    if(ebidang=='Kesehatan Masyarakat'){   
        $("#seksi option[value='Seksi Kesehatan Ibu dan Anak']").show();
        $("#seksi option[value='Seksi Kesehatan Lingkungan dan Promosi Kesehatan']").show();
        $("#seksi option[value='Seksi Pemberdayaan Masyarakat dan Gizi']").show();
    }
    if(ebidang=='Pencegahan Pemberantasan Penyakit'){
        $("#seksi option[value='Seksi P2 Tular Vektor dan Zoonotik']").show();
        $("#seksi option[value='Seksi P2 Tidak Menular dan Surveilans']").show();
        $("#seksi option[value='Seksi P2 Penyakit Menular Langsung']").show();
    }
    if(ebidang=='Sumber Daya Kesehatan'){
        $("#seksi option[value='Seksi Kefarmasian dan Perbekalan Kesehatan']").show();
        $("#seksi option[value='Seksi Sumber Daya Manusia Kesehatan']").show();
        $("#seksi option[value='Seksi Informasi dan Pengendalian Sarana Kesehatan']").show();
    }
    if(ebidang=='Sekretariat'){
        $("#seksi option[value='Sub bag Perencanaan dan Evaluasi']").show();
        $("#seksi option[value='Sub bag Keuangan dan Aset']").show();
        $("#seksi option[value='Sub bag Umum Kepegawaian']").show();
    }
    if(ebidang=='Pelayanan Kesehatan'){
        $("#seksi option[value='Seksi Pelayanan Kesehatan Primer dan Tradisional']").show();
        $("#seksi option[value='Seksi Pelayanan Kesehatan Rujukan']").show();
        $("#seksi option[value='Seksi Jaminan Kesehatan dan Kemitraan']").show();
    }
}

function ocbidang(bidang){
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


    if(bidang=='Kepala Dinas'){
        $("#seksi option[value='-']").show();
        $("#seksi option[value='Pilih']").hide();
        
        document.getElementById("seksi").selectedIndex=1;
    }
    if(bidang=='Kesehatan Masyarakat'){   
        $("#seksi option[value='Seksi Kesehatan Ibu dan Anak']").show();
        $("#seksi option[value='Seksi Kesehatan Lingkungan dan Promosi Kesehatan']").show();
        $("#seksi option[value='Seksi Pemberdayaan Masyarakat dan Gizi']").show();
        
    }
    if(bidang=='Pencegahan Pemberantasan Penyakit'){
        $("#seksi option[value='Seksi P2 Tular Vektor dan Zoonotik']").show();
        $("#seksi option[value='Seksi P2 Tidak Menular dan Surveilans']").show();
        $("#seksi option[value='Seksi P2 Penyakit Menular Langsung']").show();
    }
    if(bidang=='Sumber Daya Kesehatan'){
        $("#seksi option[value='Seksi Kefarmasian dan Perbekalan Kesehatan']").show();
        $("#seksi option[value='Seksi Sumber Daya Manusia Kesehatan']").show();
        $("#seksi option[value='Seksi Informasi dan Pengendalian Sarana Kesehatan']").show();
    }
    if(bidang=='Sekretariat'){
        $("#seksi option[value='Sub bag Perencanaan dan Evaluasi']").show();
        $("#seksi option[value='Sub bag Keuangan dan Aset']").show();
        $("#seksi option[value='Sub bag Umum Kepegawaian']").show();
    }
    if(bidang=='Pelayanan Kesehatan'){
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

            var tempat="<?php echo $pengajuan->tempat; ?>";
            var acara="<?php echo $pengajuan->acara; ?>";
            var id="<?php echo $pengajuan->id; ?>";
            // console.log(id);
            // if(tempat=="Aula ABC"){
                // console.log(tempat);
                // console.log(acara);
            // }

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
                            if (data.tempat == "Aula A B C & Ruang Rapat Lt 9") {
                                // console.log(data.tempat);
                                if(data.id==id){
                                    if(AulaA=="ada"&&AulaB=="ada"&&
                                        AulaC=="ada"&&RuangRapatLt9=="ada"){
                                        RuangRapatLt9 = "ada";
                                        AulaA = "ada";
                                        AulaB = "ada";
                                        AulaC = "ada";
                                        document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                        document.getElementById('AulaA').style.visibility = "hidden";
                                        document.getElementById('AulaB').style.visibility = "hidden";
                                        document.getElementById('AulaC').style.visibility = "hidden";
                                    }
                                    else{
                                        RuangRapatLt9 = "";
                                        AulaA ="";
                                        AulaB ="";
                                        AulaC ="";
                                    }
                                }
                                else{
                                    RuangRapatLt9 = "ada";
                                    AulaA = "ada";
                                    AulaB = "ada";
                                    AulaC = "ada";
                                    document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                    document.getElementById('AulaA').style.visibility = "hidden";
                                    document.getElementById('AulaB').style.visibility = "hidden";
                                    document.getElementById('AulaC').style.visibility = "hidden";                         
                                }

                                // return data;
                            }
                            // if (data.tempat == "Aula ABC"&&data.tempat!=tempat&&data.acara!=acara) {
                            if (data.tempat == "Aula A B C") {
                                // AulaA = "ada";
                                // AulaB = "ada";
                                // AulaC = "ada";

                                // if(data.tempat==tempat&&data.acara==acara){
                                // if(data.tempat==tempat&&data.id==id){
                                if(data.id==id){
                                    if(AulaA=="ada"&&AulaB=="ada"&&AulaC=="ada"){
                                        AulaA = "ada";
                                        AulaB = "ada";
                                        AulaC = "ada";
                                        document.getElementById('AulaA').style.visibility = "hidden";
                                        document.getElementById('AulaB').style.visibility = "hidden";
                                        document.getElementById('AulaC').style.visibility = "hidden";
                                    }
                                    else{
                                        AulaA ="";
                                        AulaB ="";
                                        AulaC ="";
                                    }
                                    // console.log("abc id");
                                    // AulaA ="";
                                    // AulaB ="";
                                    // AulaC ="";
                                }
                                else{
                                    AulaA = "ada";
                                    AulaB = "ada";
                                    AulaC = "ada";
                                    document.getElementById('AulaA').style.visibility = "hidden";
                                    document.getElementById('AulaB').style.visibility = "hidden";
                                    document.getElementById('AulaC').style.visibility = "hidden";                         
                                }

                                return data;

                                // console.log(data.tempat);
                            }

                            if (data.tempat == "Aula A B & Ruang Rapat Lt 9") {
                                if(data.id==id){
                                    if(AulaA=="ada"&&AulaB=="ada"&&RuangRapatLt9=="ada"){
                                        RuangRapatLt9 = "ada";
                                        AulaA = "ada";
                                        AulaB = "ada";
                                        document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                        document.getElementById('AulaA').style.visibility = "hidden";
                                        document.getElementById('AulaB').style.visibility = "hidden";    
                                    }
                                    else{
                                        RuangRapatLt9 = "";
                                        AulaA ="";
                                        AulaB =""; 
                                    }
                                }
                                else{
                                    RuangRapatLt9 = "ada";
                                    AulaA = "ada";
                                    AulaB = "ada";
                                    document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                    document.getElementById('AulaA').style.visibility = "hidden";
                                    document.getElementById('AulaB').style.visibility = "hidden";

                                    if (AulaC != "") {
                                        AulaC = "ada";
                                        document.getElementById('AulaC').style.visibility = "hidden";
                                    } else {
                                        AulaC = "";
                                    }                                    
                                }
                                return data;
                            }
                            // if (data.tempat == "Aula AB") {
                            if (data.tempat == "Aula A B") {
                                // if(data.tempat==tempat&&data.acara==acara){
                                // if(data.tempat==tempat&&data.id==id){
                                if(data.id==id){
                                    if(AulaA=="ada"&&AulaB=="ada"){
                                        AulaA = "ada";
                                        AulaB = "ada";
                                        document.getElementById('AulaA').style.visibility = "hidden";
                                        document.getElementById('AulaB').style.visibility = "hidden";    
                                    }
                                    else{
                                        AulaA ="";
                                        AulaB =""; 
                                    }
                                    // console.log("ab id");
                                    // console.log(data.id);
                                    // console.log(id);
                                    // AulaA ="";
                                    // AulaB ="";
                                }
                                else{
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
                                }

                                // AulaA = "ada";
                                // AulaB = "ada";

                                // // AulaC="";
                                // if (AulaC != "") {
                                //     AulaC = "ada";
                                // } else {
                                //     AulaC = "";
                                // }
                                return data;
                            }

                            if (data.tempat == "Aula B C & Ruang Rapat Lt 9"){
                                if(data.id==id){
                                    if(AulaB=="ada"&&AulaC=="ada"&&RuangRapatLt9=="ada"){
                                        RuangRapatLt9 = "ada";
                                        AulaB = "ada";
                                        AulaC = "ada";
                                        document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                        document.getElementById('AulaB').style.visibility = "hidden";
                                        document.getElementById('AulaC').style.visibility = "hidden";
                                    }
                                    else{
                                        RuangRapatLt9 = "";
                                        AulaB ="";
                                        AulaC ="";
                                    }
                                }
                                else{
                                    RuangRapatLt9 = "ada";
                                    AulaB = "ada";
                                    AulaC = "ada";
                                    document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                    document.getElementById('AulaB').style.visibility = "hidden";
                                    document.getElementById('AulaC').style.visibility = "hidden";

                                    if (AulaA != "") {
                                        AulaA = "ada";
                                        document.getElementById('AulaA').style.visibility = "hidden";
                                    } else {
                                        AulaA = "";
                                    }
                                }
                                return data;
                            }
                            // if (data.tempat == "Aula BC"){
                            if (data.tempat == "Aula B C"){
                                // if(data.tempat==tempat&&data.acara==acara){
                                // if(data.tempat==tempat&&data.id==id){
                                if(data.id==id){
                                    // console.log("bc id");
                                    // console.log(data.id);
                                    // console.log(id);
                                    // AulaB ="";
                                    // AulaC ="";
                                    if(AulaB=="ada"&&AulaC=="ada"){
                                        AulaB = "ada";
                                        AulaC = "ada";
                                        document.getElementById('AulaB').style.visibility = "hidden";
                                        document.getElementById('AulaC').style.visibility = "hidden";
                                    }
                                    else{
                                        AulaB ="";
                                        AulaC ="";
                                    }
                                }
                                else{
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
                                    // console.log("a");
                                }
                                        
                                // AulaB = "ada";
                                // AulaC = "ada";

                                // if (AulaA != "") {
                                //     AulaA = "ada";
                                // } else {
                                //     AulaA = "";
                                // }

                                return data;
                            }

                            if (data.tempat == "Aula A & Ruang Rapat Lt 9") {
                                if(data.id==id){
                                    if(AulaA=="ada"&&RuangRapatLt9=="ada"){
                                        RuangRapatLt9 = "ada";
                                        AulaA="ada";
                                        document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                        document.getElementById('AulaA').style.visibility = "hidden";
                                    }
                                    else{
                                    RuangRapatLt9 = "";
                                    AulaA ="";
                                    }
                                }
                                else{
                                    RuangRapatLt9 = "ada";
                                    AulaA = "ada";
                                    document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                    document.getElementById('AulaA').style.visibility = "hidden";
                                }
                                
                                return data;
                            }

                            if (data.tempat == "Aula A") {
                                // if(data.tempat==tempat&&data.acara==acara){
                                // if(data.tempat==tempat&&data.id==id){
                                if(data.id==id){
                                    if(AulaA=="ada"){
                                        AulaA="ada";
                                        document.getElementById('AulaA').style.visibility = "hidden";
                                    }
                                    else{
                                    // console.log("a id");
                                    // console.log(data.id);
                                    // console.log(id);
                                    AulaA ="";
                                    }
                                    // return data;
                                }
                                // if(data.tempat==tempat&&data.id!=id){
                                // if(data.tempat==tempat&&data.id!=id){
                                else{
                                    // console.log("id_beda"
                                    //     )
                                    AulaA = "ada";
                                    document.getElementById('AulaA').style.visibility = "hidden";
                                    // return data;
                                    // console.log("a");
                                }
                                // AulaA = "ada";
                                
                                return data;
                            }

                            if (data.tempat == "Aula B & Ruang Rapat Lt 9") {
                                if(data.id==id){
                                    if(AulaB=="ada"&&RuangRapatLt9=="ada"){
                                        RuangRapatLt9 = "ada";
                                        AulaB="ada";
                                        document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                        document.getElementById('AulaB').style.visibility = "hidden";

                                    }
                                    else{
                                        RuangRapatLt9 = "";
                                        AulaB =""; 
                                    }
                                }
                                else{
                                    RuangRapatLt9 = "ada";
                                    AulaB = "ada";
                                    document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                    document.getElementById('AulaB').style.visibility = "hidden";    
                                }

                                return data;
                            }

                            if (data.tempat == "Aula B") {
                                // if(data.tempat==tempat&&data.acara==acara){
                                // if(data.tempat==tempat&&data.id==id){
                                if(data.id==id){
                                    if(AulaB=="ada"){
                                        AulaB="ada";
                                        document.getElementById('AulaB').style.visibility = "hidden";
                                    }
                                    else{
                                        AulaB =""; 
                                    }
                                    // console.log("b id");
                                    // console.log(data.id);
                                    // console.log(id);
                                    // AulaB ="";
                                }
                                else{
                                    AulaB = "ada";
                                    document.getElementById('AulaB').style.visibility = "hidden";    
                                }
                                // console.log(data.tempat);
                                // AulaB = "ada";

                                // return data;
                            }

                            if (data.tempat == "Aula C & Ruang Rapat Lt 9") {
                                if(data.id==id){
                                    if(AulaC=="ada"&&RuangRapatLt9=="ada"){
                                        RuangRapatLt9 = "ada";
                                        AulaC="ada";
                                        document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                        document.getElementById('AulaC').style.visibility = "hidden";
                                    }
                                    else{
                                        RuangRapatLt9 = "";
                                        AulaC =""; 
                                    }
                                }
                                else{
                                    RuangRapatLt9 = "ada";
                                    AulaC = "ada";
                                    document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                    document.getElementById('AulaC').style.visibility = "hidden";
                                }

                                return data;
                            }

                            if (data.tempat == "Aula C") {
                                // AulaC = "ada";
                                // if(data.tempat==tempat&&data.acara==acara){
                                // if(data.tempat==tempat&&data.id==id){
                                if(data.id==id){
                                    if(AulaC=="ada"){
                                        AulaC="ada";
                                        document.getElementById('AulaC').style.visibility = "hidden";
                                    }
                                    else{
                                        AulaC =""; 
                                    }
                                    // console.log("c id");
                                    // console.log(data.id);
                                    // console.log(id);
                                    // AulaC ="";
                                }
                                else{
                                    AulaC = "ada";
                                    document.getElementById('AulaC').style.visibility = "hidden";
                                }

                                return data;
                            }

                            if (data.tempat == "Ruang Rapat Lt 9") {
                            // console.log(data.tempat);
                                if(data.id==id){
                                    // console.log("idlt9");
                                    if(RuangRapatLt9=="ada"){
                                        RuangRapatLt9="ada";
                                        document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                    }
                                    else{
                                        RuangRapatLt9 =""; 
                                    }
                                }
                                else{
                                    // console.log("bukanpunyaini");
                                    RuangRapatLt9 = "ada";
                                    document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                                    // console.log(RuangRapatLt9);
                                }

                                // return data;
                            }


                            else {
                                // document.getElementById('penuh').style.visibility = "visible";

                                return null;
                            }


                        });

                        // if (AulaA == "ada") {
                        //     console.log('ceka')
                        //     document.getElementById('AulaA').style.visibility = "hidden";
                        // }
                        // if (AulaB == "ada") {
                        //     console.log('cekb')
                        //     document.getElementById('AulaB').style.visibility = "hidden";
                        // }
                        // if (AulaC == "ada") {
                        //     console.log('cekc')
                        //     document.getElementById('AulaC').style.visibility = "hidden";
                        // }
                        // if (RuangRapatLt9 == "ada") {
                        //     console.log('ceklt9')
                        //     document.getElementById('RuangRapatLt9').style.visibility = "hidden";
                        // }
                        if (AulaA == "ada" && AulaB == "ada" && AulaC == "ada" && RuangRapatLt9 == "ada"){
                            document.getElementById('penuh').style.visibility = "visible";
                        }
                        
                        RuangRapatLt9 = "";
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
            var tanggal = $('#tanggal').val();
            // console.log(tanggal);
            var jam_m = $('#jam_m').val();
            var jam_s = $('#jam_s').val();

            var idbidang="<?php echo $pengajuan->bidang; ?>";
            var idseksi="<?php echo $pengajuan->seksi; ?>";
            // console.log(idbidang);
            
            document.getElementById('bidang').value=idbidang;
            document.getElementById('seksi').value=idseksi;
            editbidang();


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
