
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  @include('template.head')
</head>
<body class="hold-transition sidebar-mini" onload="onload();">
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
        <div class="card">
          <div class="card-body">
            <div class="card" >
              <div class="card-body" style="display:flex; align-items:center; justify-content: center;">
                <video id="idle_video" width="70%" height="70%" controls playsinline muted preload autoplay onended="onVideoEnded();">
                 
                  <script type="text/javascript">
                    var a = <?php echo json_encode($profile) ?>;
                    console.log(a);
                    var vid = [];
                    for(var i=0; i<a.length; i++){
                      console.log(a[i].video);
                      vid.push("video/"+a[i].video);
                    }
                    console.log(vid);
                    var vid_i = 0;
                    var vid_player = null;
                    function onload(){
                      vid_player = document.getElementById("idle_video");
                      vid_player.setAttribute("src", vid[vid_i]);
                      vid_player.play();
                    }
                    function onVideoEnded(){
                      if(vid_i<vid.length-1){
                        vid_i++;
                      }
                      else{
                        vid_i=0;
                      }
                      vid_player.setAttribute("src", vid[vid_i]);
                      vid_player.play();
                    }

                  </script>
                </video>
              </div>
              <marquee><b>{{$teks_berjalan}}</b></marquee>
            </div>
            
            <a href="{{route('profile/edit')}}" class="btn btn-success btn-lg btn-block" role="button" aria-pressed="true">EDIT</a>
          </div>

        </div>   
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
  document.getElementById('idProfile').style.backgroundColor = "rgba(255,255,255,.1)";
  document.getElementById('idpProfile').style.color = "white";

});
</script>
</body>
</html>