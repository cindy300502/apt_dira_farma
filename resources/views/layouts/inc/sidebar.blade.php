  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route ('landingpage')  }}" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Apotek Dira Farma</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('Image/765-default-avatar.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->name }}
          </a>
          {{-- <span>{{ Auth::user()->email }}</span> --}}
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{ url('home') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                  Dashboard
                    {{-- <span class="right badge badge-danger">New</span> --}}
                  </p>
                </a>
              </li>
    
              @if (in_array(Auth::user()->level, [1,3]))
                <li class="header">MASTER</li>
                  <a href="{{ url('kategori') }}" class="nav-link">
                  <i class="fas fa-window-maximize"></i>
                    <p>
                    Kategori
                      {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                  </a>
                </li>
                  <a href="{{ url('merk') }}" class="nav-link">
                  <i class="fas fa-window-maximize"></i>
                    <p>
                    Pabrik
                      {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                  </a>
                </li>
                <li>
                <a href="{{ url('produk') }}" class="nav-link">
                <i class="fas fa-cubes"></i>
                    <p>
                    Produk
                      {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                  </a>
                </li>
                <li>
                <a href="{{ url('supplier') }}" class="nav-link">
                <i class="fas fa-truck"></i>
                    <p>
                    Supplier
                      {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                  </a>
                </li>
              @endif
    
              <li class="header">TRANSAKSI</li>
                <a href="{{ url('transaksi') }}" class="nav-link">
                <i class="fas fa-money-bill-wave"></i>
                  <p>
                  Penjualan
                    {{-- <span class="right badge badge-danger">New</span> --}}
                  </p>
                </a>
              </li>
              @if (in_array(Auth::user()->level, [1,3]))
                <li>
                  <a href="{{ url('transaksi-pembelian') }}" class="nav-link">
                  <i class="fas fa-cart-arrow-down"></i>
                      <p>
                      Pembelian
                        {{-- <span class="right badge badge-danger">New</span> --}}
                      </p>
                  </a>
                </li>
                <li class="header">REPORT</li>
                  {{-- <a href="{{ url('home') }}" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <p>
                      Laporan
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                  </a> 
                  <a href="{{ route('selling-report-page') }}" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <p>
                      Laporan Penjualan
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                  </a>
                </li>
              @endif
            
              {{-- <li class="header">SYSTEM</li>
                <a href="{{ url('user') }}" class="nav-link">
                <i class="fas fa-user-cog"></i>
                  <p>
                    User
                    {{-- <span class="right badge badge-danger">New</span> --}}
                  </p>
                </a>
              </li>
              {{-- <li>
              <a href="{{ url('home') }}" class="nav-link">
              <i class="fas fa-cogs"></i>
                  <p>
                  Pengaturan
                    {{-- <span class="right badge badge-danger">New</span> 
                  </p>
                </a>
              </li> --}} 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
