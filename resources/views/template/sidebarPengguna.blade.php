<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
      <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block" style="word-wrap: break-word">{{ ucwords($pengguna->username) }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <!-- <li class="nav-item menu-is-opening menu-open"> -->
                <li class="nav-item menu-open">
                    <a href="{{ route('pengajuan/daftarsemua/hariini') }}" class="nav-link" id="idpengajuan">
                        <!-- <i class="nav-icon fas fa-th"></i> -->
                        <p id="idppengajuan">
                            Pengajuan
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="iddaftarsemua">
                            <a href="{{ route('pengajuan/daftarsemua/hariini') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p id="idpdaftarsemua">
                                    Daftar Semua
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" id="idtambah">
                            <a href="{{ route('pengajuan/create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p id="idptambah">
                                    Tambah
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" id="iddaftarsaya">
                            <a href="{{ route('pengajuan/daftarsaya/hariini') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p id="idpdaftarsaya">
                                    Daftar Saya
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item" id="idprofile">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <!-- <i class="nav-icon fas fa-th"></i> -->
                        <p id="idpprofile">
                            Profile
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item" id="iduser">
                    <a href="{{ route('user') }}" class="nav-link">
                        <!-- <i class="nav-icon fas fa-th"></i> -->
                        <p id="idpuser">
                            User
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <!-- <i class="nav-icon fas fa-th"></i> -->
                        <p>
                            Logout
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
