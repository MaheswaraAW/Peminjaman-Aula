<!DOCTYPE html>
<html>
<head>
  @include('template.head')
</head>
<body>
    <div class="container">
<form action="{{route('postLogin')}}" method="post" >
    	{{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="acara" placeholder="Acara" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="tempat" placeholder="Tempat" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div >
        Tanggal Mulai
      </div>
      <div class="form-group has-feedback">
        <input type="date" class="form-control" name="tanggal_mulai" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      Tanggal Selesai
      <div class="form-group has-feedback">
        <input type="date" class="form-control" name="tanggal_selesai" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      Jam
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="jam_mulai" required="" placeholder="mulai">
        <input type="text" class="form-control" name="jam_akhir" required="" placeholder="akhir">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="bidang" placeholder="Bidang" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="seksi" placeholder="Seksi" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="pemesan" placeholder="Pemesan" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Pesan</button>
        </div>
      </div>
    </form>
</div>
</body>
@include('template.script')