 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
      <img src="{{ url('storage/logo/'.App\Models\Config::where('id', 1)->first()->logo) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ App\Models\Config::where('id', 1)->first()->name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a id="dashboard"  href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>           
          </li>
          <li class="nav-item">
            <a id="pembeli" href="/pembeli" class="nav-link">
              <i class="nav-icon fas fa-fw fa-users"></i>
              <span>Pembeli</span>
            </a>
          </li> 
          <li class="nav-item">
            <a id="barang" href="/barang" class="nav-link">
              <i class="nav-icon fas fa-fw fa-folder-open"></i>
              <span>Barang</span>
            </a>
          </li> 
          <li class="nav-item">
            <a id="transaksi" href="/transaksi" class="nav-link">
              <i class="nav-icon fas fa-fw fa-poll-h"></i>
              <span>Transaksi</span>
            </a>
          </li> 
          <li class="nav-item">
            <a id="labarugi" href="/labarugi" class="nav-link">
              <i class="nav-icon fas fa-fw fa-file-invoice"></i>
              <span>Laba Rugi</span>
            </a>
          </li> 
          <li class="nav-item">
            <a id="pengaturan" href="/pengaturan" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <span>Pengaturan</span>
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="/logout" class="nav-link">
              <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
              <span>Keluar</span>
            </a>
          </li>   
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  