<!-- cartlist.blade.php -->
@extends('master')
@section('content')
@if(Session::has('user'))
    @if(session('success') || isset($success) || isset($orderSuccess))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') ?? $success ?? $orderSuccess }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        </script>
    @endif
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

<div class="slide-in-element" style="background-color:#f6eaea">
    <img src="{{asset('storage/logo-brand/logo.jpg')}}" style="width:200px;height:200px;">
    <h1>LKN Perfume</h1>
</div>
<div class="container" id="home">

    <div class="row">

        <div class="col-sm-3">
            <div class="list-group pt-2 pb-4" style="cursor:pointer;">
                <a class="text-primary list-group-item list-group-item-action active" onclick="filterOrdersByStatus('all'); changeTab(this);">Tất cả đơn hàng</a>
                <a class="text-primary list-group-item list-group-item-action" onclick="filterOrdersByStatus(1); changeTab(this);">Đơn đang xử lí</a>
                <a class="text-primary list-group-item list-group-item-action" onclick="filterOrdersByStatus(2); changeTab(this);">Đơn hoàn thành</a>
                <a class="text-primary list-group-item list-group-item-action" onclick="filterOrdersByStatus(3); changeTab(this);">Đơn đã hủy</a>
            </div>
        </div>

        <div class="col-sm-9">
            @php
                $prevOrderDetailId = null;
            @endphp

            @foreach($products as $orderDetail)

                @if ($orderDetail->id !== $prevOrderDetailId)
                <div class="row border-bottom mb-3 order " data-status="{{ $orderDetail->status }}">
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
                            ngày mua : {{ \Carbon\Carbon::parse($item->purchase_date)->format('H:i:s d/m/Y') }}<br>
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
                        @elseif ($orderDetail->status == 1)
                            <div class="row">
                                <ul class="progressbar">
                                    <li class="active">Chờ xử lí </li>
                                    <li class="active">Đã nhận</li>
                                    <li>Đã giao</li>
                                </ul>
                            </div>
                        @elseif ($orderDetail->status == 2)
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
    function changeTab(element) {
        var items = document.querySelectorAll(".list-group-item");
        items.forEach(function(item) {
            item.classList.remove("active");
        });

        element.classList.add("active");
    }
</script>

<script>
    function filterOrdersByStatus(status) {
        var allOrders = document.querySelectorAll('.order');
        allOrders.forEach(function(order) {
            var orderStatus = order.getAttribute('data-status');
            if (orderStatus === status.toString() || status === 'all') {
                order.style.display = 'block';
            } else {
                order.style.display = 'none';
            }
        });
    }
</script>


@else
<script>
    window.onload = function() {
        Swal.fire({
            icon: 'error',
            title: 'Please log in to view your orders',
            showConfirmButton: false,
            timer: 2000
        }).then(function() {
            window.location.href = '{{ route("login") }}';
        });
    }
</script>
@endif

@endsection
