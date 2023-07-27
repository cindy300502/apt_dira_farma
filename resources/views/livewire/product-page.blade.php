@push('stylesheet')
  <link rel="stylesheet" href="{{ asset('css/product-page.css') }}">
@endpush

<div class="product-page">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
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
          <h3 class="card-title">Tambah Data Produk</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <form wire:submit.prevent='store_product' class="card-body">
          <div class="input-group">
            <input wire:model='name' type="text" class="form-control" placeholder="Nama produk">
            @error('name')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="select-group">
              <select wire:model='brand_id' class="form-select" aria-label="Merk">
                  <option value='' hidden selected>Pilih Pabrik</option>
                  @foreach ($ProductBrands as $ProductBrand)
                      <option value="{{ $ProductBrand->id }}">{{ $ProductBrand->nama_merk }}</option>
                  @endforeach
              </select>
              @error('brand_id')
                <small class="error">{{ $message }}</small>  
              @enderror
          </div>
          <div class="select-group">
              <select wire:model='category_id' class="form-select" aria-label="Kategori">
                  <option value='' hidden selected>Pilih kategori</option>
                  @foreach ($Categories as $category)
                      <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                  @endforeach
              </select>
              @error('category_id')
                <small class="error">{{ $message }}</small>  
              @enderror
          </div>
          <div class="select-group">
              <select wire:model='type' class="form-select" aria-label="Kategori">
                  <option value='' hidden selected>Pilih tipe</option>
                  <option value="Generic">Generic</option>
                  <option value="Bebas">Bebas</option>
                  <option value="Paten">Paten</option>
                  {{-- <option value="Paten">Lainnya</option> --}}
              </select>
              @error('type')
                <small class="error">{{ $message }}</small>  
              @enderror
          </div>

          <div class="input-group">
            <input wire:model='harga_jual' type="text" class="form-control" placeholder="Harga Jual">
            @error('harga_jual')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="input-group">
            <input wire:model='stok' type="number" class="form-control" placeholder="Stok Produk" min="0">
            @error('stok')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="row-wrapper">
            <span class="row-tittle"> Expired </span>
            <div class="input-group">
              <input wire:model='expired' type="date" class="form-control" placeholder="Expired">
              @error('expired')
                <small class="error">{{ $message }}</small>
              @enderror
          </div>
          </div>
          <div class="input-group">
            <input wire:model='description' type="text" class="form-control" placeholder="Deskripsi (mg/ml/tipe)">
            @error('description')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="input-group">
            <input wire:model='picture' type="file" class="form-control" placeholder="Deskripsi" accept="image/*">
            @error('picture')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="button-container">
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
          </div>
        </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Edit Product -->
      @if ($ProductEdit)
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Data Produk</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <form wire:submit.prevent='edit_product' class="card-body">
            <div class="input-group">
              <input wire:model='name_edit' type="text" class="form-control" placeholder="Nama Produk">
              @error('name_edit')
                <small class="error">{{ $message }}</small>
              @enderror
            </div>
            
            <div class="select-group">
              <select wire:model='category_id_edit' class="form-select" aria-label="Kategori">
                <option value='' hidden selected>Pilih kategori</option>
                @foreach ($Categories as $category)
                    <option
                      @if ($category->id == $category_id_edit)
                          selected
                      @endif
                      value="{{ $category->id }}"                     
                      >{{ $category->nama_kategori }}
                    </option>
                @endforeach
              </select>
              @error('category_id_edit')
                <small class="error">{{ $message }}</small>  
              @enderror
          </div>

            <div class="input-group">
              <input wire:model='harga_jual_edit' type="text" class="form-control" placeholder="Harga Jual">
              @error('harga_jual_edit')
                <small class="error">{{ $message }}</small>
              @enderror
            </div>
            <div class="input-group">
              <input wire:model='stok_edit' type="text" class="form-control" placeholder="Stok Produk">
              @error('stok_edit')
                <small class="error">{{ $message }}</small>
              @enderror
            </div>
            <div class="input-group">
              <input wire:model='expired_edit' type="date" class="form-control" placeholder="Expired Produk">
              @error('expired_edit')
                <small class="error">{{ $message }}</small>
              @enderror
            </div>
            <div class="button-container">
              <button type="submit" class="btn btn-primary">Edit Produk</button>
            </div>
          </form>
          <!-- /.card-body -->
        </div>          
      @endif
      <!-- /.card -->

      <div class="card">
        <div class="card-body">
          <div class="powergrid-container">
            <livewire:products-table />
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