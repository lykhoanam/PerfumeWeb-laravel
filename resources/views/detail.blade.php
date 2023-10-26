@extends('master')
@section('content')

@if(isset($success))
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
<style>
    .center-text {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
    }
</style>
<div class="container">
    <div class="row">
        <form action="/add_to_cart" method="POST">
            <div class="col-sm-6 text-center">
                <img class="detail-image" src="{{ asset($products['gallery']) }}">
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <p>{{$products['name']}}</p>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> Giá </p>
                    </div>
                    <div class="col-sm-9 align-items-center">
                        <p>₫{{$products['price']}}</p>

                    </div>
                </div>

                <div class="row">
                    <p>Số lượng: (còn {{$products['quantity']}} )</p>
                    <div class="input-group col-sm-3">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[1]">
                            <span class="glyphicon glyphicon-minus"></span>
                        </button>
                        </span>
                        <input type="text" id="quantityInput" name="quantity" class="form-control input-number input-sm text-center input1" value="1" min="1" max="{{$products['quantity']}}">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        </span>
                    </div>
                </div>

                <input type="hidden" name="product_id" value="{{$products['id']}}">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <button class="btn btn-cart"  style="width:250px;height:50px"><i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart</button>
                    </div>
                    <div class="col-sm-6">
                        <a href="/cartlist" class="btn btn-success center-text" style="width: 250px">Buy now</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quantityInput = document.getElementById('quantityInput');
        var plusButton = document.querySelector('[data-type="plus"]');
        var minusButton = document.querySelector('[data-type="minus"]');

        plusButton.addEventListener('click', function () {
            var currentValue = parseInt(quantityInput.value, 10);
            if (!isNaN(currentValue)) {
                quantityInput.value = currentValue + 1;
            }
        });

        minusButton.addEventListener('click', function () {
            var currentValue = parseInt(quantityInput.value, 10);
            if (!isNaN(currentValue) && currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        var input1 = document.getElementById('input1');
        var input2 = document.getElementById('input2');

        // Sử dụng sự kiện input để tự động cập nhật giá trị
        input1.addEventListener('input', function() {
        // Cập nhật giá trị của input2 khi input1 thay đổi
        input2.value = input1.value;
        });


    });


</script>



@endsection
