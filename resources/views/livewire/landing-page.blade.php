@push('stylesheet')
    <link href="css/landing_app.css" rel="stylesheet" />
@endpush

<div class="landing-page">
    {{-- Navigation --}}

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">Apotek Dira Farma</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                @auth
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="btn btn-primary btn-x0 text-uppercase" href="{{ route('home-page') }}">Admin Dashboard</a></li>
                    </ul>
                @else
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="btn btn-primary btn-x0 text-uppercase" href="{{ url('login') }}">Login</a></li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading text-dark">Welcome To Apotek Dira Farma</div>
            <div class="masthead-heading text-dark">It's Nice To Meet You</div>
        </div>
    </header>

    <div class="container search">
        <div class="input-form mb-3">
            <input type="text" wire:model='filter' class="form-control" placeholder="cari produk ...">
        </div>
    </div>

    <section class="page-section" id="card">
        <div id="product-card-container" class="container">
            @foreach ($Products as $product)
                <div class="card" style="width: 18rem;">
                    @if ($product->foto)
                        <img src="{{ asset('storage/'.$product->foto) }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama_produk }}</h5>
                        <div class="card-content">
                            <div class="row-wrapper">
                                <span>Harga</span>
                                <span>{{ formatRupiah($product->harga_jual) }}</span>
                            </div>
                            <div class="row-wrapper">
                                <span>Kategori</span>
                                <span>{{ $product->category->nama_kategori }}</span>
                            </div>
                            <div class="row-wrapper">
                                <span>Stok</span>
                                <span>{{ $product->stok }}</span>
                            </div>
                            <div class="row-wrapper">
                                <span>Expired</span>
                                <span>{{ $product->expired }}</span>
                            </div>
                        </div>
                        <div class="button-wrapper">
                            <button wire:click='getDetail({{ $product }})' class="btn btn-primary details-button">Detail</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="container">
            <div class="pagination-container">
                <div class="pagination">
                    {{ $Products->links() }}
                </div>
            </div>
        </div>
    </section>

    @push('modal-placeholder')
        <div id="description-modal" class="description-modal">
            <div class="container">
                <div class="product-card-description">
                    <div class="image-container">
                        <img src="{{ asset('storage\product\rufHVibGjhZxRGbc8VVVN8wKp3ituXANZCVqfNTr.jpg') }}" alt="">
                    </div>
                    <div class="content-wrapper">
                        <span class="card-title">Amoxilin</span>
                        <div class="row-wrapper">
                            <span>Harga</span>
                            <span class="card-price"></span>
                        </div>
                        <div class="row-wrapper">
                            <span>Pabrik</span>
                            <span class="card-brand"></span>
                        </div>
                        <div class="row-wrapper">
                            <span>Kategori</span>
                            <div class="card-category"></div>
                        </div>
                        <div class="row-wrapper">
                            <span>Expired</span>
                            <div class="card-expired"></div>
                        </div>
                        <div class="card-text"></div>
                        <div class="button-container">
                            <button id="description-closed" class="btn btn-primary">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    @endpush

</div>

@push('script')

    <script src="{{ asset('/') }}//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="{{ asset('/') }}//cdn.startbootstrap.com/sb-forms-latest.js"></script>

    <script>
        function formatToRupiah(number) {
        if (typeof number !== 'number') {
            throw new Error('Input must be a number.');
        }

        const numberString = number.toString().replace(/,/g, '');
        const formattedNumber = numberString.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        const rupiahString = `Rp ${formattedNumber}`;

        return rupiahString;
        }




        // handle Product Description modal
        
        function showDescriptionModal(product) {
            console.log(product)

            let descriptionModal = $('#description-modal')
            descriptionModal.addClass('active')
            
            descriptionModal.find('.card-title').first().text(product.nama_produk)
            descriptionModal.find('.card-price').first().text(formatToRupiah(product.harga_jual))
            descriptionModal.find('.card-brand').first().text(product.brand.nama_merk)
            descriptionModal.find('.card-category').first().text(product.category.nama_kategori)
            descriptionModal.find('.card-expired').first().text(product.expired)
            descriptionModal.find('.card-text').first().text(product.deskripsi)
            
            if (product.foto) {
                descriptionModal.find('.image-container img').first().attr('src', 'storage/' + product.foto)
                descriptionModal.find('.image-container').first().removeClass('hide')
            } else {
                descriptionModal.find('.image-container').first().addClass('hide')
            }
            

        }
        
        function hideDescriptionModal() {
            $('#description-modal').removeClass('active')
        }

        $('#description-closed').click(function () {
            hideDescriptionModal()
        })

        $( window ).on('open-modal', function (e) {
            let productDetails = e.detail[0]
            showDescriptionModal(productDetails)
        })


    </script>
        
@endpush