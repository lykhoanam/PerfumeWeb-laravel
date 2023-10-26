@extends('master')
@section('content')
<form id="checkoutForm" action="/orderplace" method="POST">
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
            <div class="col-sm-6" style="border:1px solid black;padding: 30px;">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong style="text-align:start" >Địa chỉ</strong>
                        </div>
                        <div class="col-sm-6 form-group">
                            <textarea placeholder="Enter your address..." style="resize:none" name="address" class="form-control"> </textarea>

                        </div>
                    </div>
                    <hr style="border: none; border-top: 2px solid #eae0e0;">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong style="text-align:start">Người Nhận</strong>
                        </div>
                        <div class="col-sm-6">
                            @foreach($products as $item)
                                <h5 style="text-align:end">{{ $item->username }}</h5>
                            @endforeach
                        </div>
                    </div>
                    <hr style="border: none; border-top: 2px solid #eae0e0;">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong style="text-align:start">Phương thức thanh toán</strong>
                        </div>
                        <div class="col-sm-6">
                            <p style="text-align:end"><input type="radio" value="Online" name="payment"><span>Online payment</span></p>
                            <p style="text-align:end"><input type="radio" value="Cash" name="payment"><span>Cash</span></p>
                        </div>
                    </div>
                    <hr style="border: none; border-top: 2px solid #eae0e0;">
                    <div class="row">
                        <div class="col-sm-6">
                            <strong style="text-align:start">Ghi chú</strong>
                        </div>
                        <div class="col-sm-6 form-group">
                            <textarea placeholder="Enter your message..." style="resize:none" name="message" class="form-control"> </textarea>

                        </div>
                    </div>

                    <hr style="border: none; border-top: 2px solid #b2adad;">

                    <div class="row">
                        <div class="col-sm-6">
                            <strong style="text-align:start">Tổng Cộng = </strong>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('checkoutForm').addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        function validateForm() {
            var address = document.getElementsByName('address')[0].value;
            var payment = document.querySelector('input[name="payment"]:checked');

            var isValid = true;

            if (address.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng nhập địa chỉ!!',
                    showConfirmButton: false,
                    timer: 2000
                })
                isValid = false;
            }

            if (!payment) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng chọn phương thức thanh toán.!',
                    showConfirmButton: false,
                    timer: 2000
                })
                isValid = false;
            }

            return isValid;
        }
    });
</script>

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
