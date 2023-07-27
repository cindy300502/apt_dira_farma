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

        {{-- Jquery CDN --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

        <link href="css/styles.css" rel="stylesheet" />
            
        <link href="css/landing_page.css" rel="stylesheet" />
        @stack('stylesheet')

        @livewireStyles
    <body id="page-top">

      @stack('modal-placeholder')

      <div class="app">
        {{ $slot }}
      </div>


      @stack('script')

      @livewireScripts
    </body>
</html>
