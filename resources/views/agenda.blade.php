<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en" style="width: 100vw; height: 100vh;">
<head style="width: 100vw; height: 20vh;">
  @include('template.head')

  <div style="float:left; width: 80vw;">
    <div style="display:inline-flex;">
      <img width="15%" height="10%" src="{{asset('logo_dinkes_semarang.png')}}">
      <h3 style="padding-top: 2%; color: #FFFFFF; font-weight: bold">Dinas Kesehatan Kota Semarang</h3>
    </div>
  </div>
  <div class="mt-2 mr-2" style="float:right; color: #FFFFFF;">
    <div>
      <div id="data" style="font-weight: bold">
      </div>
      <div>
        <h3 id="jam" style="float:right; font-weight: bold">
        </h3>
      </div>
    </div>
  </div>
</head>
<body style="background-color: #000000;width: 100vw; height: 80vh">
<!-- <div class="wrapper" style="overflow:hidden"> -->
  <div class="wrapper">
    <div class="content">
      <div class="row" style="align-items:center; width: 100vw;">
        <div class="col-md-6" >
          <div class="card" style="">
            <div class="card-body">
              <video width="100%" height="100%" controls autoplay muted loop>
                <source src="{{asset('video/'.$video_pertama)}}" type="video/mp4">
              </video>
            </div>
          </div>
        </div>
        <div class="col-md-6" style="width: 100vw; height:75vh;"">
          <h4 style="text-align:center; color:#FFFFFF; font-weight: bold;">
            Jadwal Kegiatan Hari Ini
          </h4>
          <div style="height: 70vh;">
            <div class="card" style="background-color: #000000;">
              <div class="card-body px-0" style="overflow-y: scroll; height: 70vh;">
                <table class="table" style="background-color:#ffffff; width: 100%">
                  @foreach($pengajuan as $p)
                  <tr style="font-weight: bold; border-bottom: 7px solid; border-color: #000000">
                      <td style="text-align: center; vertical-align: middle; background-color:#FF00FF; color: white; border-width: 0; ">{{$p->jam_m."-".$p->jam_s}}</td>
                      <td style="border-width: 0; background-color: #BA55D3; color: white;">{{$p->acara}}</td>
                      <td style="background-color: #C71585; color: #FFFFFF; text-align: center; vertical-align: middle; border-width: 0; ">{{$p->tempat}}</td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
         </div>
        </div>
      </div>
      <div class="row" style="color: #FFFFFF; width: 100vw; font-size: 24px">
          <marquee><b>{{$teks_berjalan}}</b></marquee>
      </div>
    </div>
      <!-- </div> -->
    <!-- </div> -->
      <!-- /.content -->
      
  <!-- </div> -->
    <!-- /.content-wrapper -->
    
    <!-- /.control-sidebar -->


  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
@include('template.script')


<script>
  function func(){
    var clientTime = new Date();
    
    var time= new Date(clientTime.getTime());

    var sb=new Date().toLocaleDateString();
    const p=sb.split("/");

    var sd=time.getDay();
    
    var sh=time.getHours().toString();
    var sm=time.getMinutes().toString();
    var ss=time.getSeconds().toString();

    switch(sd){
      case 0: sd = "Minggu";
    break;
      case 1: sd = "Senin";
    break;
      case 2: sd = "Selasa";
    break;
      case 3: sd = "Rabu";
    break;
      case 4: sd = "Kamis";
    break;
      case 5: sd = "Jumat";
    break;
      case 6: sd = "Sabtu";
    break;
    }


  document.getElementById("data").innerHTML=(sd)+", "+(p[1]+"/"+p[0]+"/"+p[2]);

  document.getElementById("jam").innerHTML=(sh.length==1?"0"+sh:sh)+":"+(sm.length==1?"0"+sm:sm)+":"+(ss.length==1?"0"+ss:ss);

  }
  func();

  setInterval(func, 1000);

</script>
</body>
</html>