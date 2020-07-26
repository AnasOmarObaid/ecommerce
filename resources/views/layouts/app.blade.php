<!DOCTYPE html>

<html dir="{{LaravelLocalization::getCurrentLocaleDirection()}}" lang="{{LaravelLocalization::getCurrentLocale()}}"
    class="fontawesome-i2svg-active fontawesome-i2svg-complete">

<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('title')

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- bootstrap  --}}
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">

    {{--  owl carousel --}}
    <link rel="stylesheet" href="{{asset('public/css/owl.carousel.min.css')}}">

    {{-- animate css --}}
    <link rel="stylesheet" href="{{asset('public/css/animate.css')}}">

    {{-- fotorama css   --}}
    <link rel="stylesheet" href="{{asset('public/css/fotorama.css')}}">

    {{-- style css   --}}
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">

    @if (app()->getLocale() == 'ar')

    {{-- bootstrap rtl --}}
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.rtl.min.css')}}">

    {{-- font awsome --}}
    <link rel="stylesheet" href="{{asset('public/css/font.rtl.min.css')}}">

    {{-- style rtl --}}
    <link rel="stylesheet" href="{{asset('public/css/style-rtl.css')}}">

    <!-- sweetalert -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet" />

    {{-- google font --}}
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Cairo', sans-serif;
        }
    </style>
    @endif


</head>

<body>


    {{-- start header nav and header--}}

    @include('layouts._header')

    @yield('content')

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

    {{--  subscribe --}}
    @include('layouts.subscribe')

    {{-- footer --}}
    @include('layouts.footer')

    {{-- jquery js --}}
    <script src="{{asset('public/js/jquery.min.js')}}"></script>

    {{-- pooper js --}}
    <script src="{{asset('public/js/popper.min.js')}}"></script>

    {{-- bootstrap js --}}
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>

    {{-- fontawesome --}}
    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js"></script>

    {{-- owl carousel --}}
    <script src="{{asset('public/js/owl.carousel.min.js')}}"></script>

    {{-- fotorama js --}}
    <script src="{{asset('public/js/fotorama.js')}}"></script>

    {{-- main js --}}
    <script src="{{asset('public/js/main.js')}}"></script>

    {{-- scripts --}}
    <script>
        $('#main-slider').owlCarousel({
            items: 1,
            rtl: true,
            dots: true,
            nav: true,
            loop: true

        });
        $('#new-stores-slider , #quick-offers-slider , #most-sells-slider').owlCarousel({
            items: 4,
            rtl: true,
            dots: true,
            loop: true,
            nav: true,
            margin: 20,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,

                },
                1200: {
                    items: 4,

                }
            }

        });
    </script>

    {{-- print this js --}}
    <script src="{{asset('public/js/printThis.js')}}">
    </script>

    <script>
        $(document).on('click', '.print-det-btn', function(){
            
      $('#print-product_det').printThis();
      });
    </script>
    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</body>

</html>