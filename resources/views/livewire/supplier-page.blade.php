@push('stylesheet')
  <link rel="stylesheet" href="{{ asset('css/supplier-page.css') }}">
@endpush

<div class="supplier-page">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Supplier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{\Request::route()->getName()
              }}</li>
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
          <h3 class="card-title">Tambah Data Supplier</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <form wire:submit.prevent='store_supplier' class="card-body">
          <div class="input-group">
            <input wire:model='name' type="text" class="form-control" placeholder="Nama Supplier">
            @error('name')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="input-group">
            <input wire:model='alamat' type="text" class="form-control" placeholder="Alamat">
            @error('alamat')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="input-group">
            <input wire:model='no_telepon' type="number" class="form-control" placeholder="No Telepon">
            @error('no_telepon')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="button-container">
            <button type="submit" class="btn btn-primary">Tambah supplier</button>
          </div>
        </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      {{-- Edit Card --}}
      @if ($SupplierEdit)
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Data Supplier</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form wire:submit.prevent='edit_supplier' class="card-body">
              <div class="input-group">
                <input wire:model='name_edit' type="text" class="form-control" placeholder="Nama Supplier">
                @error('name_edit')
                  <small class="error">{{ $message }}</small>
                @enderror
              </div>
              <div class="input-group">
                <input wire:model='alamat_edit' type="text" class="form-control" placeholder="Alamat">
                @error('alamat_edit')
                  <small class="error">{{ $message }}</small>
                @enderror
              </div>
              <div class="input-group">
                <input wire:model='no_telepon_edit' type="number" class="form-control" placeholder="No Telepon">
                @error('no_telepon_edit')
                  <small class="error">{{ $message }}</small>
                @enderror
              </div>
              <div class="button-container">
                <button type="submit" class="btn btn-primary">Edit supplier</button>
              </div>
            </form>
          </div>
        </div>
      @endif

      <div class="card">
        <div class="card-body">
          <div class="powergrid-container">
            <livewire:supplier-table />
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