@push('stylesheet')
  <link rel="stylesheet" href="{{ asset('css/buying-transaction-page.css') }}">
@endpush

<div class="buying-transaction-page">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaksi Pembelian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaksi Pembelian</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <!-- Main content -->
    <section class="content container">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah data transaksi pembelian</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <form wire:submit.prevent='store_transaction' class="card-body">
            <div class="select-group">
                <select wire:model='id_supplier' class="form-select" aria-label="Supplier">
                    <option value='' hidden selected>Pilih supplier</option>
                    @foreach ($Supplier as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                    @endforeach
                </select>
                @error('id_supplier')
                  <small class="error">{{ $message }}</small>  
                @enderror
            </div>
            <div class="select-group">
                <select wire:model='id_produk' class="form-select" aria-label="Produk">
                    <option value='' hidden selected>Pilih produk</option>
                    @foreach ($Product as $produk)
                        <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                    @endforeach
                </select>
                @error('id_produk')
                  <small class="error">{{ $message }}</small>  
                @enderror
            </div>
            <div class="select-group">
                <select wire:model='id_brand' class="form-select" aria-label="Brand">
                    <option value='' hidden selected>Pilih merk</option>
                    @foreach ($Brand as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->nama_merk }}</option>
                    @endforeach
                </select>
                @error('id_brand')
                  <small class="error">{{ $message }}</small>  
                @enderror
            </div>
            <div class="input-group">
              <input wire:model='total_item' type="number" class="form-control" placeholder="Jumlah item" min="0">
              @error('total_item')
                <small class="error">{{ $message }}</small>
              @enderror
            </div>
            <div class="input-group">
              <input wire:model='harga' type="number" class="form-control" placeholder="Harga">
              @error('harga')
                <small class="error">{{ $message }}</small>
              @enderror
            </div>

          <div class="sub-total-container">
            
          </div>

          <div class="button-container">
            <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
          </div>
        </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      

      <div class="card">
        <div class="card-body">
          <div class="powergrid-container">
            <livewire:buying-transaction-table />
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
</div>

@push('script')
<script>
    
    

    
</script>
@endpush