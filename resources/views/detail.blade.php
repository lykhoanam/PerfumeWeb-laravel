@extends('master')
@section('content')

<div class="container">
    <div class="row">
        <form action="/add_to_cart" method="POST">
        <div class="col-sm-6">
            <img class="detail-image" src="{{ asset($products['gallery']) }}">
        </div>
        <div class="col-sm-6">
            <p>{{$products['name']}}</p>
            <hr>
            <p>₫{{$products['price']}}</p>
            <hr>
            <p>Quantity: </p>
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
            <hr>
            <p>Deal sốc     mua để nhận quà </p>
            <hr>

                <input type="hidden" name="product_id" value="{{$products['id']}}">
                @csrf
                <button class="btn btn-cart"  style="width:250px;height:50px"><i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart</button>
            </form>
            <button class="btn btn-success" style="width:250px;height:50px"><i class="fa fa-eye"></i> Buy now</a>
        </div>
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
