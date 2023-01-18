
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
  @include('template.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('template.sidebarAdmin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-12 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTodoModal">Tambah</button>
            </div>
            </div>
            <div class="row" style="clear: both;margin-top: 18px;">
                <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penggunaall as $key=>$pg)
                        <tr id="pengguna_{{$pg->id}}">
                            <td>{{$key+1}}</td>
                            <td>{{ $pg->username }}</td>
                            <td>{{ $pg->password }}</td>
                            <td>{{ $pg->nama }}</td>
                            <td>{{ $pg->level }}</td>
                            <td>
                                <a data-id="{{ $pg->id }}" onclick="editTodo(event.target)" class="btn btn-info">Edit</a>
                                <a class="btn btn-danger" onclick="deleteTodo({{ $pg->id }})">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    
</div>
<div class="modal fade" id="addTodoModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah User</h4>
        </div>
        <div class="modal-body">
                <!-- <input type="hidden" id="stoken" name="_token" value="{{csrf_token()}}"> -->
                <meta name="csrf-token" content="{{csrf_token()}}">
                <div class="form-group">
                    <!-- <label for="name" class="col-sm-2">Username</label> -->
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <label for="name" class="col-sm-2">Password</label> -->
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <label for="name" class="col-sm-2">Nama</label> -->
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <label for="name" class="col-sm-2">Username</label> -->
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="level" name="level" placeholder="level">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="Tambah()" id= "tambahs">Save</button>
        </div>
    </div>
  </div>
  
</div>
<div class="modal fade" id="editTodoModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Todo</h4>
        </div>
        <div class="modal-body">

               <input type="hidden" name="todo_id" id="todo_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2">Task</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="edittask" name="todo" placeholder="Enter task">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="updateTodo()">Save</button>
        </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
@include('template.script')
<script>
    function Tambah() {
      // console.log("klik");
        var username = $('#username').val();
        var password = $('#password').val();
        var nama = $('#nama').val();
        var level = $('#level').val();

        // console.log(username);
        // console.log(password);
        // console.log(nama);

        let _url     = `/simpan_user`;
        // let _token   = $('meta[name="csrf-token"]').attr('content');
        // let _token   = $('#stoken').val();

        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                username: username,
                password: password,
                nama: nama,
                level: level,
                // _token: _token

                },
            success: function(data) {
                    console.log("berhasil");
                    // pengguna = data
                    var no=1;
                    $('table tbody').append(`
                        <tr id="pengguna_${data.id}">
                            <td>${data.length}</td>
                            <td>${data.username}</td>
                            <td>${ data.password }</td>
                            <td>${ data.nama }</td>
                            <td>${ data.level }</td>
                            <td>
                                <a data-id="${data.id}" onclick="editTodo(${data.id})" class="btn btn-info">Edit</a>
                                <a data-id="${data.id}" class="btn btn-danger" onclick="deleteTodo(${data.id})">Delete</a>
                            </td>
                        </tr>
                    `);

                    $('#username').val('');
                    $('#password').val('');
                    $('#nama').val('');
                    $('#level').val('');

                    // $('#addTodoModal').modal('hide');
            },
            error: function(response) {
                // $('#taskError').text(response.responseJSON.errors.pengguna);
            }
        });
    }
</script>
</body>
</html>