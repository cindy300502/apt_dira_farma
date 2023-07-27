@push('stylesheet')
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endpush

<div class="homepage">
    <div class="container">
        <div class="head-card-wrapper">
            <div class="report-card">
                <div class="details-wrapper">
                    <div class="hero-number">{{ $this->stock_count }}</div>
                    <span class="detail-title">Stok</span>
                    <span class="detail-subtitle">produk yang hampir habis</span>
                </div>
                <div class="icon-wrapper">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
            <div class="report-card">
                <div class="details-wrapper">
                    <div class="hero-number">{{ $this->expired_count }}</div>
                    <span class="detail-title">Expired</span>
                    <span class="detail-subtitle">produk yang hampir kadaluwarsa</span>
                </div>
                <div class="icon-wrapper">
                    <i class="fas fa-exclamation red"></i>
                </div>
            </div>
            <div class="report-card">
                <div class="details-wrapper">
                    <div class="hero-number">{{ $this->sales_count }}</div>
                    <span class="detail-title">Penjualan</span>
                    <span class="detail-subtitle">Penjualan produk dalam bulan berjalan</span>
                </div>
                <div class="icon-wrapper">
                    <i class="fas fa-dollar-sign green"></i>
                </div>
            </div>
        </div>
    </div>
</div>