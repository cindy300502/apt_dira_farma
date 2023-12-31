
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Selamat Datang</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('/')}}plugins/fontawesome-free/css/all.min.css">
        <!-- Google fonts-->
        <link href="{{ asset('/') }}//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}//fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
            
        <link href="css/landing_page.css" rel="stylesheet" />
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/navbar-logo.svg" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="btn btn-primary btn-x0 text-uppercase" href="{{ url('login') }}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading text-dark">Welcome To Apotek Dira Farma</div>
                <div class="masthead-heading text-dark">It's Nice To Meet You</div>
            </div>
        </div>
    </header>
    
    <div class="container search"  >
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2" >
                <i class="fas fa-search"></i>
            </span>
          </div>
        </div>
    <!--Card Bootstrap-->
    <section class="page-section" id="card">
            <div id="product-card-container" class="container" >
                @foreach (range(0,8) as $item)
                    
                <div class="card" style="width: 18rem;">
                    <img src="https://images.k24klik.com/product/large/apotek_online_k24klik_20211223092009359225_AMOXICILLIN-KF-500MG-TAB-100S-removebg-preview.png" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
                @endforeach
                  
                  </div>
               <!-- Bootstrap core JS-->
        <script src="{{ asset('/') }}//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at {{ asset('/') }}//startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="{{ asset('/') }}//cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
