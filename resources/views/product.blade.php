@extends('master')
@section('content')

@if(isset($success) || session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '{{ $success ?? session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif



    <div class="animated-element" style="height:100%;padding-top:50px;" id="home">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                    <div class="item active">
                        <img class="slider-img" src="{{asset('storage/img/item4.jpg')}}" alt="Chania">
                        <div class="carousel-caption">
                            <h3>LKN Perfume</h3>
                            <p>LKN is always so much fun!</p>
                        </div>
                    </div>
                    <div class="item ">
                        <img class="slider-img" src="{{asset('storage/img/item10.jpg')}}" alt="Chania">
                        <div class="carousel-caption">
                            <h3>LKN Perfume</h3>
                            <p>LKN is always so much fun!</p>
                        </div>
                    </div>
                    <div class="item ">
                        <img class="slider-img" src="{{asset('storage/img/item8.jpg')}}" alt="Chania">
                        <div class="carousel-caption">
                            <h3>LKN Perfume</h3>
                            <p>LKN is always so much fun!</p>
                        </div>
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
    </div>

<div class="logo-brand animated-element" style="padding:3%;">
    <div class="" style="border: 5px solid #0b0b0b;box-shadow:5px 5px 5px black;">

        <div class="swiper mySwiper ">
            <div class="swiper-wrapper">

                    <?php
                        $logo = array("afnan.png","alaia.png","anna sui.png","armaf .png","bond.png","britney spears.png","burberry.png",
                        "bvlgari.png","calvin klein.png","caroline herrera.png","chanel .png","chloe.png");

                        foreach ($logo as $image)
                        {
                            echo "<div class='swiper-slide'><img src='" . asset("storage/logo-brand/$image") . "'></div>";
                        }
                    ?>
            </div>
            <div class="swiper-button-next" style="color:black;"></div>
            <div class="swiper-button-prev" style="color:black;"></div>
        </div>
    </div>
</div>


<div class="lkn-container animated-element" style="background-color:rgb(250, 243, 243)">
    <div class="row">
        <p class="divider">Bộ sưu tập</p>
    </div>

    <div class="row" style="">
        <div class="col-sm-3">
            <a href="/forher">
                <img src="{{asset('storage/img/forher.jpg')}}" alt="forher" class="homeImage">
                <div class="centered">For her</div>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="/forhim">
                <img src="{{asset('storage/img/forhim.jpg')}}" alt="forhim" class="homeImage">
                <div class="centered">For him</div>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="/unisex">
                <img src="{{asset('storage/img/unisex.jpg')}}" alt="unisex" class="homeImage">
                <div class="centered">Unisex</div>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="/giftset">
                <img src="{{asset('storage/img/giftset.jpg')}}" alt="giftset" class="homeImage">
                <div class="centered">Gift set</div>
            </a>
        </div>
    </div>
</div>

<div class="lkn-container animated-element" style="background-color:rgb(195, 166, 166)">
    <div class="row">
        <div class="divider" style="color:white">About us</div>
    </div>
    <div class="row text-center" style="">
        <p style="font-size:16px;color:white">Chào mừng bạn đến với LKN Perfume - nơi bạn khám phá thế giới của mùi hương đẳng cấp. Tại đây, chúng tôi tự hào giới
            thiệu những sản phẩm nước hoa chất lượng từ các thương hiệu hàng đầu trên thế giới. Hãy để chúng tôi là người đồng hành trong hành
            trình tìm kiếm hương thơm hoàn hảo của bạn.
        </p>
    </div>
    <div class="row">
        <div class="swiper mySwiper3">
            <div class="swiper-wrapper">
                <div class='swiper-slide'><img src='{{asset("storage/img/item5.jpg")}}' style="opacity:0.5"></div>
            </div>
        </div>

    </div>
</div>


<div class="lkn-container animated-element" style="">
    <div class="row">
        <p class="divider">Suggestions for you</p>
    </div>


    <div class="row">
        @isset($products)
            @php
               $shuffledProducts = $products->toArray();
                shuffle($shuffledProducts);

                $selectedProducts = array_slice($shuffledProducts, 0, 4);
            @endphp

            @foreach($selectedProducts as $item)
                <div class="col-sm-3">
                    <a href="detail/{{$item['id']}}" style="text-decoration:none;" onmouseover="showImage(this)" onmouseout="hideImage(this)">
                        <img class="homeImage main-image" src="{{ asset($item['gallery']) }}">
                        <img class="homeImage secondary-image" style="display:none;"  src="{{ asset("storage/img/home1.png") }}">
                        <div class="imageBody">
                            <h4 class="text-center">{{$item['name']}}</h4><br>
                        </div>
                    </a>
                </div>
            @endforeach
        @endisset
    </div>
</div>


<div class="container animated-element">
    <div class="row">
        <div class="swiper mySwiper3">
            <div class="swiper-wrapper">
                <div class='swiper-slide'><img src='{{asset("storage/img/sale1.jpg")}}'></div>
            </div>
        </div>
    </div>
</div>

<div class="lkn-container animated-element">
    <div class="row">
        <p class="divider">Up to 50%</p>
    </div>

    <div class="row">
        @isset($products)
            @php
               $shuffledProducts = $products->toArray();
                shuffle($shuffledProducts);

                $selectedProducts = array_slice($shuffledProducts, 0, 4);
            @endphp

            @foreach($selectedProducts as $item)
                <div class="col-sm-3">
                    <a href="detail/{{$item['id']}}" style="text-decoration:none;" onmouseover="showImage(this)" onmouseout="hideImage(this)">
                        <img class="homeImage main-image" src="{{ asset($item['gallery']) }}">
                        <img class="homeImage secondary-image" style="display:none;"  src="{{ asset("storage/img/home1.png") }}">
                        <div class="imageBody">
                            <h4 class="text-center">{{$item['name']}}</h4><br>
                        </div>
                    </a>
                </div>
            @endforeach
        @endisset
    </div>
</div>
<script>
    const observer = new IntersectionObserver((entries)=>{
        entries.forEach((entry) =>{
            console.log(entry)
            if(entry.isIntersecting){
                entry.target.classList.add('show');
            }else{
                entry.target.classList.remove('show');
            }
        })
    })

    const hidden = document.querySelectorAll('.animated-element');
    hidden.forEach((el)=>observer.observe(el));
</script>
@endsection
