<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('storage/logo-brand/logotitle.png') }}" type="image/x-icon" />
    <title>LKN Perfume </title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('storage/css/cdn.jsdelivr.net_npm_swiper@10.3.0_swiper-bundle.min.css')}}">
<link rel="stylesheet" href="{{asset('storage/css/style.css')}}">

<!-- Optional theme -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Add these links in the head of your HTML file -->

</head>
<body>
    {{View::make('header')}}
    @yield('content')
    {{View::make('footer')}}
</body>
<script src="{{asset('storage/js/cdn.jsdelivr.net_npm_swiper@10.3.0_swiper-bundle.min.js')}}"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
            //effect: "coverflow",
            //centeredSlides: true,
            /*coverflowEffect: {
            rotate: 30,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
            },*/
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
                },
            slidesPerView: 6,
            spaceBetween: 30,

            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

</script>

<script>
    var swiper = new Swiper(".mySwiper1", {
            autoHeight: true,
            slidesPerView: 2,
            spaceBetween: 30,
            height: 100,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

</script>

<script>
    var swiper = new Swiper(".mySwiper2", {
            autoHeight: true,
            slidesPerView: 4,
            spaceBetween: 30,
            height: 100,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var mySwiper4 = new Swiper('.mySwiper4', {
            // your Swiper configuration options here
            // for example:
            slidesPerView: 6,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    });

</script>

<script>
    function showImage(element) {
        element.querySelector('.main-image').style.display = 'none';
        element.querySelector('.secondary-image').style.display = 'block';
    }

    function hideImage(element) {
        element.querySelector('.main-image').style.display = 'block';
        element.querySelector('.secondary-image').style.display = 'none';
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slideElement = document.querySelector('.slide-in-element');
        slideElement.classList.add('active');

        setTimeout(function() {
            slideElement.classList.remove('active');
            slideElement.classList.add('inactive');
        }, 2000);
    });
</script>

</html>
