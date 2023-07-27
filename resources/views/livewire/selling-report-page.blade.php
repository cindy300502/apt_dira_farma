@push('stylesheet')
  <link rel="stylesheet" href="{{ asset('css/selling-report-page.css') }}">
@endpush

<div class="report-page">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Penjualan</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <!-- Main content -->
    <section class="content container">
      <div class="card">
        <div class="card-body">
          <div class="powergrid-container">
            <livewire:selling-report-table />
          </div>
        </div>
      </div>
    </section>

    @if ($this->detail_state_id)
      <section class="content container">
        <div class="card">
          <div class="card-title-container">
            <span class="card-title">Detail Transaksi</span>
            <span>ID Transaksi : {{ $this->detail_state_id }}</span>
          </div>
          <div class="card-body">
            <div class="powergrid-container">
              <livewire:transaction-product-table filter='{{ $this->detail_state_id }}' />
            </div>
          </div>
        </div>
      </section>        
    @endif
    

</div>

@push('script')
<script>
    
    

    
</script>
@endpush