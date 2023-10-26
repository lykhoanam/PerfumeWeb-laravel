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
