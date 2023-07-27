@push('stylesheet')
  <link rel="stylesheet" href="{{ asset('css/transaction-page.css') }}">
@endpush

<div class="transaction-page">
    <div class="container">
        <div class="page-title">
            <h1>Transaksi</h1>
        </div>
        <div class="transaction-card container-fill">
            <div class="transaction-card-header">
                <h2>Cari Produk</h2>
            </div>
            <div class="power-grid-table powergrid-table-container">
                <livewire:selling-products-table />
            </div>
        </div>
        <div class="page-row-content-wrapper">
            <div class="card-column-wrapper">
                <div class="transaction-card">
                    <div class="transaction-card-header">
                        <h2>Produk Dibeli</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Nama Produk</th>
                                    <th>Merk</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Jumlah Item</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Product->whereIn('id', $this->selected_product_ids) as $product)
                                    <tr>
                                        <td>{{ $product->category->nama_kategori }}</td>
                                        <td>{{ $product->nama_produk }}</td>
                                        <td>{{ $product->brand->nama_merk }}</td>
                                        <td>{{ formatRupiah($product->harga_jual) }}</td>
                                        <td>{{ formatRupiah( $this->calculateTotal($product->harga_jual, $this->getQty($product->id) ) ) }}</td>
                                        <td>
                                            <input wire:change='setQty({{ $product }}, $event.target.value)' class="form-control" type="number" value='{{ $this->getQty($product->id) }}' >
                                            {{-- <input wire:change='setQty({{ $product->id }}, $event.target.value)' class="form-control" type="number" value='{{ $this->getQty($product->id) }}' > --}}
                                        </td>
                                        <td>
                                            <button wire:click='delete_selected({{ $product->id }})' class="btn btn-danger btn-small">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="summary-card-wrapper">
                <div class="transaction-card summary-card">
                    <div class="summary-title">Detail Transaksi</div>
                    <div class="card-item-wrapper">
                        <div class="row-wrapper">
                            <span class="row-title">Jumlah Produk</span>
                            <span class="row-item">{{ sizeof($this->selected_product) }}</span>
                        </div>
                        <div class="row-wrapper">
                            <span class="row-title">Diskon (%)</span>
                            <input wire:model='discount' class="row-item form-control" type="number" min="0" max="100" step="5">
                        </div>
                        @error('discount')
                            <small class="error row-item" style="color: red; text-align:end">{{ $message }}</small>
                        @enderror
                        <div class="row-wrapper">
                            <span class="row-title">Harga</span>
                            <span class="row-item">{{ formatRupiah($this->subTotal) }}</span>
                        </div>
                        <div class="row-wrapper">
                            <span class="row-title"></span>
                            <span class="row-item">-{{ formatRupiah($this->discount_price) }}</span>
                        </div>
                        <div class="row-wrapper">
                            <span class="row-title">Sub Total</span>
                            <span class="row-item">{{ formatRupiah($this->payment) }}</span>
                        </div>
                    </div>
                    <div class="button-wrapper">
                        <button wire:click='create_transaction' class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>