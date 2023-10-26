@extends('master')
@section('content')

@if(isset($success) || isset($orderSuccess))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: '{{ $success }}',
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
@endif
<div class="custom-product">
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
                    <img class="slider-img" src="{{asset('storage/img/item1.png')}}" alt="Chania">
                    <div class="carousel-caption">
                        <h3>LKN Perfume</h3>
                        <p>LKN is always so much fun!</p>
                    </div>
                </div>
                <div class="item ">
                    <img class="slider-img" src="{{asset('storage/img/item2.png')}}" alt="Chania">
                    <div class="carousel-caption">
                        <h3>LKN Perfume</h3>
                        <p>LKN is always so much fun!</p>
                    </div>
                </div>
                <div class="item ">
                    <img class="slider-img" src="{{asset('storage/img/item3.png')}}" alt="Chania">
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

<hr>

<div class="row text-center">
    <h3 class="col-sm-12 ">Brand</h3><br>

    <div class="swiper mySwiper ">
        <div class="swiper-wrapper">

                <?php
                    $logo = array("afnan.png","alaia.png","anna sui.png","armaf .png","bond.png","britney spears.png","burberry.png",
                    "bvlgari.png","calvin klein.png","caroline herrera.png","chanel .png","chloe.png","christian dior.png","coach.png","CR7.png",
                    "creed.png","davidoff.png","diesel.png","diptyque.png","dolce & gabbana.png","dsquared2.png","elie saab.png","elizabeth arden.png",
                    "estee lauder.png","giorgio armani.png","givenchy.png","gucci.png","guerlain.png","hermes.png","hugo boss.png","issey miyake.png",
                    "jean paul gaultier.png","jo malone london.png","john varvatos.png","juicy couture.png","kenzo.png","kilia.png","lacoste.png",
                    "lady gaga.png","lalique .png","lancome .png","lancome.png","lanvin .png","le labo.png","lolita lempicka.png","maison francis kurkdjian.png",
                    "maison margiela.png","mancera .png","marc jacobs.png","MCM-logo-new-2020.png","mercedes benz.png","michael hors.png",
                    "miu miu.png","montale .png","montblanc.png","moschino .png","narciso rodriguez.png","nautica .png","paco rabanne .png",
                    "parfums de marly .png","prada.png","ralph lauren.png","roja dove.png","salvatore ferragamo.png","serge lutens.png",
                    "thierry mugler.png","tommy hilfiger.png","trussardi.png","valentino .png","vera wang.png","versace.png",
                    "victorias secret.png","viktor and rolf.png","yves saint laurent .png");

                    foreach ($logo as $image)
                    {
                        echo "<div class='swiper-slide'><img src='" . asset("storage/logo-brand/$image") . "'></div>";
                    }
                ?>
        </div>
    </div>

</div>


@endsection
