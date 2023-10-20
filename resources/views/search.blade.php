@extends('master')
@section('content')


@if(count($products) > 0)
<body>

    <div class="container">
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
                    <h5 style="text-align:start"><span class="glyphicon glyphicon-search"></span> Kết quả tìm kiếm cho: "{{$query}}"</h5>
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
                                    <div class="card-footer"></div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>

</body>
@else


    <div class="container">
        <div class="row" style="padding: 180px;">
            <h3>Không có sản phẩm nào được tìm thấy. Hãy sử dụng tử khóa chung chung hơn...</h3>
        </div>
        <hr style="border: 1px solid rgba(0, 0, 0, 0.1);">
        <div class="row">
            <h4 style="text-align:start">CÓ THỂ BẠN CŨNG THÍCH</h4>
            @foreach($randomProducts as $randomProduct)
                <div class="col-sm-2">
                    <div class="card">
                        <a href="detail/{{$randomProduct['id']}}">
                            <img class="banner-image" src="{{ asset($randomProduct['gallery']) }}">
                            <div class="card-body">
                                <h4 class="card-title text-primary">{{$randomProduct['name']}}</h4>
                                <h5>{{$randomProduct['price']}}đ</h5>
                                <p class="card-text">{{$randomProduct['description']}}</p>
                            </div>
                            <div class="card-footer"></div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endif




@endsection
