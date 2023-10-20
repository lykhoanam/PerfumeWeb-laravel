@extends('master')
@section('content')
<style>

</style>



<body>

      <div class="container ">
        <div class="row">
            <div class="col-sm-3">
                <h3>LKN Perfume</h3>
                <div class="list-group pt-2 pb-4">
                    <a href="#" class="text-primary list-group-item list-group-item-action">Category 1</a>
                    <a href="#" class="text-primary list-group-item list-group-item-action">Category 2</a>
                    <a href="#" class="text-primary list-group-item list-group-item-action">Category 3</a>

                </div>
            </div>
            <div class="col-sm-9">
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
        </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <div class="row mt-2">
                    @foreach($products as $item)
                        <div class="col-sm-4">
                            <div class="card">
                                <a href="detail/{{$item['id']}}">
                                    <img class="banner-image" src="{{ asset($item['gallery']) }}">
                                    <div class="card-body">
                                        <h4 class="card-title text-primary">{{$item['name']}}</h4>
                                        <h5>₫{{$item['price']}}</h5>
                                        <p class="card-text">{{$item['description']}}</p>
                                    </div>
                                    <div class="card-footer">

                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>



        <!--<div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <div class="row mt-2">
                    @foreach($products as $item)

                    <div class="col-md-4 p-3">
                        <div class="card">
                            <img class="banner-image" src="{{ asset($item['gallery']) }}"></div>
                            <div class="card-body">
                                <h4 class="card-title text-primary">{{$item['name']}} </h4>
                                <h5>{{$item['price']}}đ </h5>
                                <p class="card-text">{{$item['description']}} </p>
                            </div>
                            <div class="card-footer">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star uncheck"></span>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>-->
      </div>

</body>
</html>




@endsection
