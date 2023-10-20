@extends('master')
@section('content')
<form action="/orderplace" method="POST">
@csrf
    <div class="container">
        <div class="row">
            <h1 style="text-align:start"> Thanh Toán </h1>
            <div class="col-sm-6">

                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Tên</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $item)
                                <tr>
                                    <td class="vertical"><img class="thumbnail-image" src="{{ asset($item->gallery) }}" alt="{{ $item->name }}"></td>
                                    <td class="vertical">{{ $item->name }}</td>
                                    <td class="vertical">{{$item->quantity}}</td>
                                    <td class="vertical">₫{{ $item->price }}</td>
                                    <td class="vertical">{{$item->quantity * $item->price}} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
            <div class="col-sm-6" style="border:1px solid black;">
                    <div class="row">
                        <div class="col-sm-6">
                            <p style="text-align:start">Địa chỉ</p>
                        </div>
                        <div class="col-sm-6 form-group">
                            <textarea placeholder="Enter your address..." name="address" class="form-control"> </textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p style="text-align:start">Người Nhận</p>
                        </div>
                        <div class="col-sm-6">
                            <p style="text-align:end">Tên người nhận...</p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p style="text-align:start">Phương thức thanh toán</p>
                        </div>
                        <div class="col-sm-6">
                            <p style="text-align:end"><input type="radio" value="Online" name="payment"><span>Online payment</span></p>
                            <p style="text-align:end"><input type="radio" value="Cash" name="payment"><span>Cash</span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <p style="text-align:start">Ghi chú</p>
                        </div>
                        <div class="col-sm-6 form-group">
                            <textarea placeholder="Enter your message..." name="message" class="form-control"> </textarea>

                        </div>
                    </div>

                    <hr style="border: none; border-top: 2px solid #b2adad;">

                    <div class="row">
                        <div class="col-sm-6">
                            <p style="text-align:start">Tổng Cộng = </p>
                        </div>
                        <div class="col-sm-6">
                            <p style="text-align:end">₫{{$totalAmount}}</p>
                        </div>
                    </div>
            </div>
        </div>

        <div class="row sticky" >
            <table class="table cart-table p-5" >

                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Tổng sản phẩm    ({{count($products)}})</th>
                        <th>Tổng thanh toán  = ₫{{$totalAmount}}</th>
                        <th style="text-align:end"><button type="submit" class="btn btn-warning" style="width:250px;height:50px;vertical-align:middle">Đặt hàng</button></th>
                    </tr>

            </table>
        </div>
    </div>
</form>



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
    @endsection
