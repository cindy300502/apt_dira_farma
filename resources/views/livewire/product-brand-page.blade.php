@push('stylesheet')
  <link rel="stylesheet" href="{{ asset('css/brand-page.css') }}">
@endpush

<div class="brand-page">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Pabrik</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Merk</li>
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
          <h3 class="card-title">Tambah data pabrik</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <form wire:submit.prevent='store_brand' class="card-body">
          <div class="input-group">
            <input wire:model='name' type="text" class="form-control" placeholder="Nama merk">
            @error('name')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="button-container">
            <button type="submit" class="btn btn-primary">Tambah Pabrik
          </div>
        </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Edit Category -->
      {{-- @if ($CategoryEdit)
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit data kategori</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <form wire:submit.prevent='edit_category' class="card-body">
            <div class="input-group">
              <input wire:model='name_edit' type="text" class="form-control" placeholder="Nama kategori">
              @error('name_edit')
                <small class="error">{{ $message }}</small>
              @enderror
            </div>
            <div class="input-group">
              <input wire:model='description_edit' type="text" class="form-control" placeholder="Deskripsi kategori">
              @error('description_edit')
                <small class="error">{{ $message }}</small>
              @enderror
            </div>
            <div class="button-container">
              <button type="submit" class="btn btn-primary">Edit kategori</button>
            </div>
          </form>
          <!-- /.card-body -->
        </div>          
      @endif --}}
      <!-- /.card -->

      <div class="card">
        <div class="card-body">
          <div class="powergrid-container">
            <livewire:product-brand-table />
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