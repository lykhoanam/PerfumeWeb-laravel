@extends('master')
@section('content')
@if(Session::has('cart') && count(session('cart')) > 0)
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<form id="checkoutForm" action="/orderplace" method="POST">
    @csrf
    <div class="container" id="home">
        <div class="row">
            <h1 class="divider"> Thanh Toán </h1><br>
            <div class="">

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
        </div>
        <div class="container" style="background-color:#f2f2f2;padding: 5px 20px 15px 20px;border: 1px solid lightgrey;border-radius: 3px;">
                    <div class="col-sm-6">
                        <div class="row">
                            <strong style="text-align:start">Người Nhận</strong>

                            @php
                                $prevOrderDetailId = null;
                            @endphp

                            @foreach($products as $item)

                                @if ($item->username !== $prevOrderDetailId)
                                    <h5 style="text-align:start" class="form-control">{{ $item->username }}</h5>
                                @endif

                                @php
                                    $prevOrderDetailId = $item->username
                                @endphp
                            @endforeach
                        </div>

                        <div class="row">
                            <strong style="text-align:start" >Địa chỉ</strong>
                            <textarea id="address" placeholder="Enter your address..." style="resize:none" name="address" class="form-control"> </textarea>

                        </div>

                        <div class="row">
                            <strong style="text-align:start">Ghi chú</strong>
                            <textarea id="message" placeholder="Enter your message..." style="resize:none" name="message" class="form-control"> </textarea>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong style="text-align:start" >Các loại thẻ</strong>
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                                <img src="{{asset('storage/logo-brand/momo-icon.png')}}" alt="Momo Icon" style="width: 24px; height: 24px;">
                                <img src="{{asset('storage/logo-brand/vnpay-icon.jpg')}}" alt="VNPay Icon" style="width: 24px; height: 24px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <strong style="text-align:start">Phương thức thanh toán</strong>
                            </div>
                            <div class="col-sm-6">
                                <p style="text-align:start"><input type="radio" value="Online" name="payment"><span>Online payment</span></p>
                                <p style="text-align:start"><input type="radio" value="Cash" name="payment"><span>Cash</span></p>
                                <p style="text-align:start"><input type="radio" value="Momo" name="payment"><span>Momo</span></p>
                                <p style="text-align:start"><input type="radio" value="Vnpay" name="payment"><span>VNPay</span></p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <strong style="text-align:start">Tổng Cộng = </strong>
                            </div>
                            <div class="col-sm-6">
                                <p style="text-align:start" class="form-control">₫{{$totalAmount}}</p>
                            </div>
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
                        <th>Tổng thanh toán  = ₫{{$totalAmount}}
                            <input type="hidden" name="totalAmount" value="{{$totalAmount}}">
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align:end"><button type="submit" form="checkoutForm" class="btn btn-warning" style="width:250px;height:50px;vertical-align:middle" name="order">Đặt hàng</button>
                        </form>

                            <form id="momo" action="{{url('/momo_payment')}}" method="post">
                                @csrf
                                <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
                                <button type="submit" form="momo" class="btn btn-warning" style="width:250px;height:50px;vertical-align:middle;display:none;" name="payUrl">Thanh toán MoMo</button>
                            </form>

                            <form id="vnpay" action="{{url('/vnpay_payment')}}" method="post">
                                @csrf
                                <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
                                <input type="hidden" id="addressHidden" type="text" name="address" value="">
                                <input type="hidden" id="messageHidden" type="text" name="message" value="">
                                <button type="submit" form="vnpay" class="btn btn-warning" style="width:250px;height:50px;vertical-align:middle;display:none;" name="redirect">Thanh toán VNPay</button>
                            </form>
                        </th>
                    </tr>
            </table>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('checkoutForm').addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
        document.getElementById('momo').addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
        document.getElementById('vnpay').addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        var vnpayButton = document.querySelector('button[name="vnpay"]');
        var momoPaymentButton = document.querySelector('button[name="payUrl"]');
        vnpayButton.addEventListener('click', function () {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        momoPaymentButton.addEventListener('click', function () {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        function validateForm() {
            var address = document.getElementsByName('address')[0].value;
            var payment = document.querySelector('input[name="payment"]:checked');
            var message = document.getElementsByName('message')[0].value;

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
            }else

            if (!payment) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng chọn phương thức thanh toán.!',
                    showConfirmButton: false,
                    timer: 2000
                })
                isValid = false;
            }else

            if (message.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng nhập ghi chú!!',
                    showConfirmButton: false,
                    timer: 2000
                })
                isValid = false;
            }

            return isValid;
        }
    });
</script>

<script>

    document.getElementById('address').addEventListener('input', function() {
        var addressValue = this.value;
        document.getElementById('addressHidden').value = addressValue;
    });

    document.getElementById('message').addEventListener('input', function() {
        var addressValue = this.value;
        document.getElementById('messageHidden').value = addressValue;
    });

    document.addEventListener('DOMContentLoaded', function () {
        var momoRadio = document.querySelector('input[value="Momo"]');
        var cashRadio = document.querySelector('input[value="Cash"]');
        var onlineRadio = document.querySelector('input[value="Online"]');
        var vnpayRadio = document.querySelector('input[value="Vnpay"]');

        var momoPaymentButton = document.querySelector('button[name="payUrl"]');
        var orderButton = document.querySelector('button[name="order"]');
        var vnpayButton = document.querySelector('button[name="redirect"]');
        function updateButtonDisplay() {
            if (momoRadio.checked) {
                momoPaymentButton.style.display = 'block';
                orderButton.style.display = 'none';
                vnpayButton.style.display = 'none';
            } else if (vnpayRadio.checked) {
                vnpayButton.style.display = 'block';
                momoPaymentButton.style.display = 'none';
                orderButton.style.display = 'none';
            } else if (onlineRadio.checked) {
                momoPaymentButton.style.display = 'none';
                orderButton.style.display = 'block';
                vnpayButton.style.display = 'none';
            } else {
                momoPaymentButton.style.display = 'none';
                orderButton.style.display = 'block';
                vnpayButton.style.display = 'none';
            }
        }

        updateButtonDisplay();

        momoRadio.addEventListener('change', updateButtonDisplay);
        cashRadio.addEventListener('change', updateButtonDisplay);
        onlineRadio.addEventListener('change', updateButtonDisplay);
        vnpayRadio.addEventListener('change', updateButtonDisplay);

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
    @else
    <div class="container" id="empty-cart">
        <h2>Giỏ hàng trống</h2>
        <p>Giỏ hàng của bạn đang trống. Hãy thêm sản phẩm vào giỏ hàng trước khi thanh toán.</p>
    </div>
    @endif
@endsection
