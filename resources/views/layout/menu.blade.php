@if($user->level == 1)
<li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Dashboard
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="header">MASTER</li>
            <a href="{{ url('kategori') }}" class="nav-link">
            <i class="fas fa-window-maximize"></i>
              <p>
              Kategori
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li>
          <a href="{{ url('home') }}" class="nav-link">
          <i class="fas fa-cubes"></i>
              <p>
              Produk
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li>
          <a href="{{ url('home') }}" class="nav-link">
          <i class="fas fa-truck"></i>
              <p>
              Supplier
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="header">TRANSAKSI</li>
            <a href="{{ url('home') }}" class="nav-link">
            <i class="fas fa-money-bill-wave"></i>
              <p>
              Pengeluaran
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li>
          <a href="{{ url('home') }}" class="nav-link">
          <i class="fas fa-cart-arrow-down"></i>
              <p>
              Pembelian
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li>
          <a href="{{ url('home') }}" class="nav-link">
          <i class="fas fa-upload"></i>
              <p>
              Penjualan
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="header">REPORT</li>
            <a href="{{ url('home') }}" class="nav-link">
            <i class="fas fa-chart-bar"></i>
            <p>
              Laporan
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        
          <li class="header">SYSTEM</li>
            <a href="{{ url('home') }}" class="nav-link">
            <i class="fas fa-user-cog"></i>
              <p>
                User
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li>
          <a href="{{ url('home') }}" class="nav-link">
          <i class="fas fa-cogs"></i>
              <p>
              Pengaturan
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

@elseif($user->level == 2)
<li class="header">TRANSAKSI</li>
            <a href="{{ url('home') }}" class="nav-link">
            <i class="fas fa-money-bill-wave"></i>
              <p>
              Pengeluaran
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li>
          <a href="{{ url('home') }}" class="nav-link">
          <i class="fas fa-cart-arrow-down"></i>
              <p>
              Pembelian
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li>
          <a href="{{ url('home') }}" class="nav-link">
          <i class="fas fa-upload"></i>
              <p>
              Penjualan
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="header">REPORT</li>
            <a href="{{ url('home') }}" class="nav-link">
            <i class="fas fa-chart-bar"></i>
            <p>
              Laporan
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        
@endif

