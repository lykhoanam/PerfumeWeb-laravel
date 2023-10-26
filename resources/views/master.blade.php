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

    body {
        padding-top: 120px; /* Điều chỉnh giá trị này tương ứng với chiều cao của navbar */
        
        flex-direction: column;
        display:flex;
    }
    /* Màu nền cho header */
    .navbar-default {
        background-color: rgba(255, 192, 203, 0.8); /* Hồng nhạt với độ trong suốt 80% */
        border-color: rgba(255, 192, 203, 0.8);
    }

    /* Màu chữ cho menu và brand */
    .navbar-default .navbar-nav>li>a,
    .navbar-default .navbar-brand {
        color: #ffffff; /* Màu chữ trắng */
    }

    /* Màu chữ khi hover trên menu */
    .navbar-default .navbar-nav>li>a:hover {
        color: #333333; /* Đổi màu theo ý muốn của bạn */
    }

    /* Màu chữ cho toggle button */
    .navbar-default .navbar-toggle .icon-bar {
        background-color: #ffffff; /* Màu chữ trắng */
    }

    /* Màu chữ khi toggle button được nhấp vào */
    .navbar-default .navbar-toggle:hover,
    .navbar-default .navbar-toggle:focus {
        background-color: #333333; /* Đổi màu theo ý muốn của bạn */
    }

    /* Màu chữ cho dropdown menu */
    .navbar-default .navbar-nav .open .dropdown-menu>li>a {
        color: #333333; /* Đổi màu theo ý muốn của bạn */
    }

    /* Màu chữ khi dropdown menu được hover */
    .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover {
        color: #ffffff; /* Màu chữ trắng */
        background-color: #333333; /* Đổi màu theo ý muốn của bạn */
    }

    /* Màu chữ cho brand khi toggle button được nhấp vào */
    .navbar-default .navbar-toggle .navbar-brand:hover {
        color: #ffffff; /* Màu chữ trắng */
    }

    /* Màu chữ cho dropdown menu khi toggle button được nhấp vào */
    .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover {
        color: #ffffff; /* Màu chữ trắng */
    }

    a{
        color: #333;
        text-decoration: none;
    }

    .container{
        padding-top: 20px;
        flex:1;
    }

    .custom-product{
        padding-top: 20px;
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

    .row {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 30px;
    }

    .col-sm-3 {
        padding: 0;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
        transition: box-shadow 0.3s ease;
        overflow: hidden; /* Chống tràn nội dung */
    }

    .card:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .banner-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .detail-image {
        width: 70%;
        height: 70%;
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 1.2em; /* Kích thước tiêu đề */
        color: #333; /* Màu sắc tiêu đề */
    }

    .card-text {
        margin-bottom: 15px;
        color: #555; /* Màu sắc văn bản */
    }

    .card-footer {
        padding: 10px;
        background-color: #f8f9fa;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .fa-star {
        color: gold;
    }

    .uncheck {
        color: #ddd;
    }

    .card:hover{
            box-shadow: 0 10px 20px 0;
    }

    .footer{
        margin-bottom: -1rem;
    }

    .btn-cart{
        background-color: rgba(255, 192, 203, 0.8); /* Hồng nhạt với độ trong suốt 80% */
        border-color: rgba(255, 192, 203, 0.8);
    }

    .cart-quantity {
        font-size: 50%;
        background-color: #ff0000;
        color: #ffffff;
        border-radius: 50%;
        padding: 5px 8px;
        position: relative;
        top: -8px;
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
</html>
