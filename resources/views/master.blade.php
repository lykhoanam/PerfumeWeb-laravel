<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LKN Perfume </title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('storage/css/cdn.jsdelivr.net_npm_swiper@10.3.0_swiper-bundle.min.css')}}">
<link rel="stylesheet" href="{{asset('storage/css/style.css')}}">

<!-- Optional theme -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    {{View::make('header')}}
    @yield('content')
    {{View::make('footer')}}
</body>
<style>

    a{
        color: #333;
    }

    .custom-login{
        height: 500px;
        padding-top: 100px;
    }

    img.slider-img{
        height: 400px !important;
    }

    .custom-product{
        height: 400px;
    }
</style>
<script src="{{asset('storage/js/cdn.jsdelivr.net_npm_swiper@10.3.0_swiper-bundle.min.js')}}"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            centeredSlides: true,
            coverflowEffect: {
            rotate: 30,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
            },
            slidesPerView: 6,
            spaceBetween: 30,

            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    </script>
</html>
