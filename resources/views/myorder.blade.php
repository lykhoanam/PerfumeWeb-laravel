<!-- cartlist.blade.php -->
@extends('master')
@section('content')
<style>
    .myDIV{
        display:none;
    }

    .order{
        border: 1px solid rgb(195, 190, 190);
        padding: 10px;
        border-radius: 50px;
    }

    .progressbar {
        counter-reset: step;
    }
    .progressbar li {
        list-style: none;
        display: inline-block;
        width: 30.33%;
        position: relative;
        text-align: center;
        cursor: pointer;
    }
    .progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 30px;
        height: 30px;
        line-height : 30px;
        border: 1px solid #ddd;
        border-radius: 100%;
        display: block;
        text-align: center;
        margin: 0 auto 10px auto;
        background-color: #fff;
    }
    .progressbar li:after {
        content: "";
        position: absolute;
        width: 100%;
        height: 1px;
        background-color: #ddd;
        top: 15px;
        left: -50%;
        z-index : -1;
    }
    .progressbar li:first-child:after {
        content: none;
    }
    .progressbar li.active {
        color: orange;
    }
    .progressbar li.active:before {
        border-color: orange;
    }
    .progressbar li.active + li:after {
        background-color: orange;
    }
</style>

    <!--<body>

    <div class="container">
        <div class="row">
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th>Created ad</th>
                            <th>ID Product</th>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                            <tr>
                                <td class="vertical">{{ $item->purchase_date }}</td>
                                <td class="vertical">{{ $item->id }}</td>
                                <td class="vertical"><img class="thumbnail-image" src="{{ asset($item->gallery) }}" alt="{{ $item->name }}"></td>
                                <td class="vertical">{{ $item->name }}</td>
                                <td class="vertical">{{ $item->quantity }}</td>
                                <td class="vertical">₫{{ $item->price }}</td>
                                <td class="vertical">₫{{ $item->price * $item->quantity }}</td>
                                <td class="vertical">{{ $item->status }}</td>
                                <td class="vertical">{{ $item->payment_method }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    <style>
        .thumbnail-image {
            max-width: 100px;
            height: auto; /
            display: block;
            margin: auto;
        }
        .cart-table {
            border: none;
            width: 100%;
        }
        form{
            width: 100%;
        }

        .cart-table th, .cart-table td {
            border: none;
            padding: 50px;
            text-align: center;

        }

        .vertical{
            vertical-align: middle;
            margin-top: 10px;
        }

        div.sticky{
            position: -webkit-sticky;
            position: sticky;
            bottom: 0;
            background-color:white;
        }

    </style>



    </body>

-->
<style>
    .thumbnail-image {
        max-width: 100px;
        height: auto; /
        vertical-align: start;
    }


</style>

<div class="container">

    <div class="row">

        <div class="col-sm-3">
            <div class="list-group pt-2 pb-4">
                <a href="#" class="text-primary list-group-item list-group-item-action">Category 1</a>
                <a href="#" class="text-primary list-group-item list-group-item-action">Category 2</a>
                <a href="#" class="text-primary list-group-item list-group-item-action">Category 3</a>

            </div>
        </div>

        <div class="col-sm-9">
            @php
                $prevOrderDetailId = null;
            @endphp

            @foreach($products as $orderDetail)

                @if ($orderDetail->id !== $prevOrderDetailId)
                <div class="row border-bottom mb-3 order ">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>Order Detail ID: {{ $orderDetail->id }}</p>
                        </div>
                        <div class="col-sm-6" style="text-align:end">
                            <p>Created at: {{ $orderDetail->created_at }}</p>
                        </div>
                    </div>
                    @foreach($products as $item)
                    @if($item->id == $orderDetail->id)
                    <div class="row myDIV{{$orderDetail->id}}">

                        <div class="col-sm-6">
                            <div class="col-sm-6" style="text-align:end">
                                <img class="thumbnail-image" src="{{ asset($item->gallery) }}" alt="{{ $item->name }}">
                            </div>
                            <div class="col-sm-6">
                                mã sản phẩm {{$item->product_id}}<br>
                                {{ $item->name }}<br>
                                x{{ $item->quantity }}<br>
                                giá: ₫{{ $item->price }}<br>
                                tổng cộng: ₫{{ $item->price * $item->quantity }}
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <br>
                            phương thức thanh toán : {{ $item->payment_method }}<br>
                            trạng thái thanh toán : {{ $item->payment_status}}<br>
                            ngày mua : {{$item->purchase_date}}<br>
                        </div>
                    </div>
                        @endif
                        @endforeach

                        @if($orderDetail->status == 0)
                            <div class="row">
                                <ul class="progressbar">
                                    <li class="active">Chờ xử lí </li>
                                    <li>Đã nhận</li>
                                    <li>Đã giao</li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6">
                                    <form action="{{ route('cancel.order', ['orderDetailId' => $orderDetail->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" style="width:250px;height:50px;">Hủy đơn</button>
                                    </form>
                                </div>

                            </div>
                        @elseif ($item->status == 1)
                            <div class="row">
                                <ul class="progressbar">
                                    <li class="active">Chờ xử lí </li>
                                    <li class="active">Đã nhận</li>
                                    <li>Đã giao</li>
                                </ul>
                            </div>
                        @elseif ($item->status == 2)
                            <div class="row">
                                <ul class="progressbar">
                                    <li class="active">Chờ xử lí </li>
                                    <li class="active">Đã nhận</li>
                                    <li class="active">Đã giao</li>
                                </ul>
                            </div>
                        @else
                            <div class="row" style="text-align: end">
                                <div class="col-sm-6">
                                   <!-- <button onclick="toggleDetails({{ $orderDetail->id }})"><strong>Xem chi tiết đơn hàng</strong></button>-->
                                </div>
                                <div class="col-sm-6">
                                    <strong>Trạng thái đơn hàng: ĐÃ HỦY</strong>
                                </div>
                            </div>
                        @endif


                </div>
                @endif

                @php
                    $prevOrderDetailId = $orderDetail->id;
                @endphp

            @endforeach
        </div>

    </div>

</div>
<script>
    /*function toggleDetails(orderDetailId) {
        // Get all elements with class name 'myDIV'
        var elements = document.getElementsByClassName('myDIV' + orderDetailId);

        // Loop through each element and toggle its display property
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].style.display === 'none') {
                elements[i].style.display = 'block';
            } else {
                elements[i].style.display = 'none';
            }
        }
    }*/
</script>


@endsection
