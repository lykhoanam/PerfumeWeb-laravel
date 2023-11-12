<!-- cartlist.blade.php -->
@extends('master')
@section('content')

@if(count($products) > 0)
    <body>

    <div class="container" id="home">
        <div class="row">

            <form action="/checkout" method="POST" id="checkoutForm">
                @csrf
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllProducts"></th>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action<th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                            <tr>
                                <td class="vertical"><input type="checkbox" name="selected_products[]" value="{{ $item->id }}" class="product-checkbox"></td>
                                <td class="vertical"><img class="thumbnail-image" src="{{ asset($item->gallery) }}" alt="{{ $item->name }}"></td>
                                <td class="vertical">{{ $item->name }}</td>
                                <td class="vertical"><input type="number" name="quantity" min="1" class="quantity-input" data-price="{{ $item->price }}" value="{{ $item->quantity }}"></td>
                                <td class="vertical">₫{{ $item->price }}</td>
                                <td class="vertical"><a href="/removecart/{{ $item->cart_id }}" class="btn btn-warning">Remove from cart</a></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="selected_products_ids" id="selectedProductIds" >
            </form>

        </div>

        <div class="row sticky" >
            <table class="table cart-table p-5" >

                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Tổng sản phẩm: <span id="totalProducts">0</span></th>
                        <th>Tổng thanh toán: <span id="totalAmount">0</span></th>
                        <th><button type="submit" form="checkoutForm" id="orderButton" class="btn btn-warning" style="width:250px;height:50px;vertical-align:middle">Order</th>
                    </tr>

            </table>
        </div>


        <div class="container">
            <h4 class="divider">CÓ THỂ BẠN CŨNG THÍCH</h4><br>
            <div class="row">
                <div class="swiper mySwiper4">
                    <div class="swiper-wrapper">
                        @foreach($randomProducts as $randomProduct)
                            <div class="swiper-slide">
                                        <a href="detail/{{$randomProduct['id']}}">
                                            <img src="{{ asset($randomProduct['gallery']) }}">
                                        </a>

                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next" style="color:black;"></div>
                    <div class="swiper-button-prev" style="color:black;"></div>
                </div>
            </div>
        </div>


    </div>

    <script>

        var totalAmountElement = document.getElementById('totalAmount');
        var orderButton = document.getElementById('orderButton');

        function updateOrderButton() {
            var totalAmount = parseFloat(totalAmountElement.innerHTML.replace(/[^\d.-]/g, ''));
            orderButton.disabled = !(totalAmount > 0);
        }

        updateOrderButton();


        document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('.product-checkbox');
        var headerCheckbox = document.querySelector('#selectAllProducts');
        var totalAmountElement = document.getElementById('totalAmount');
        var totalProductsElement = document.getElementById('totalProducts');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                calculateTotal();
                updateOrderButton();
            });
        });

        headerCheckbox.addEventListener('change', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = headerCheckbox.checked;
            });

            calculateTotal();
            updateOrderButton();
        });

        function calculateTotal() {
            var totalAmount = 0;
            var checkedProducts = 0;
            var selectedProductIds = [];

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    var price = parseFloat(checkbox.closest('tr').querySelector('.quantity-input').getAttribute('data-price'));
                    var quantity = parseFloat(checkbox.closest('tr').querySelector('.quantity-input').value);
                    totalAmount += price * quantity;
                    checkedProducts++;
                    var productId = checkbox.value;
                    selectedProductIds.push(productId);
                }
            });

            totalAmountElement.textContent = totalAmount.toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            totalProductsElement.textContent = checkedProducts;
            document.getElementById('selectedProductIds').value = selectedProductIds.join(',');
        }
    });

    </script>

<script>
        $('.quantity-input').on('change', function () {
    var productId = $(this).closest('tr').find('.product-checkbox').val();
    var quantity = $(this).val();

    $.ajax({
        type: 'POST',
        url: '/update_cart',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId,
            quantity: quantity
        },
        success: function (response) {
            console.log(response.message);
            // You can update the UI or perform other actions as needed
        },
        error: function (error) {
            console.error('Error updating cart:', error.responseJSON.message);
        }
    });
    });

</script>







    </body>


@else


    <div class="container" id="home">
        <div class="row" style="padding: 180px;">
            <h3>Không có sản phẩm nào được tìm thấy. Hãy thêm sản phẩm vào...</h3>
        </div>
        <h4 class="divider">CÓ THỂ BẠN CŨNG THÍCH</h4><br>
        <div class="row">
            <div class="swiper mySwiper4">
                <div class="swiper-wrapper">
                    @foreach($randomProducts as $randomProduct)
                        <div class="swiper-slide">
                                    <a href="detail/{{$randomProduct['id']}}">
                                        <img src="{{ asset($randomProduct['gallery']) }}">
                                    </a>

                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next" style="color:black;"></div>
                <div class="swiper-button-prev" style="color:black;"></div>
            </div>
        </div>
    </div>

@endif




@endsection
