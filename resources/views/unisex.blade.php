@extends('master')
@section('content')
<style>

</style>

<body>
    <div class="container" id="home">
        <div class="row">
            <h3>LKN Perfume</h3>
            <div class="col-sm-3">
                <div class="list-group pt-2 pb-4" style="cursor:pointer;">
                    <a  class="text-primary list-group-item list-group-item-action active"
                        onclick="filterOrdersByPrice(0,1000000000); changeTab(this);">Tất cả</a>
                    <a  class="text-primary list-group-item list-group-item-action"
                        onclick="filterOrdersByPrice(0, 1000000); changeTab(this);">Giá < 1.000.000₫</a>
                    <a  class="text-primary list-group-item list-group-item-action"
                        onclick="filterOrdersByPrice(1000000, 2000000); changeTab(this);">1.000.000₫ ~ 2.000.000₫</a>
                    <a  class="text-primary list-group-item list-group-item-action"
                        onclick="filterOrdersByPrice(2000000, Infinity); changeTab(this);">giá > 2.000.000₫</a>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row mt-2">
                    <strong  id="noProductMessage" style="display: none;font-size:30px;text-align:center;">Không tìm thấy sản phẩm</strong>
                    @foreach($products as $item)
                        <div class="col-sm-4 order" data-price="{{ $item['price'] }}">
                            <div class="card">
                                <a href="detail/{{$item['id']}}" style="text-decoration:none;">
                                    <img class="banner-image" src="{{ asset($item['gallery']) }}">
                                    <div class="card-body">
                                        <h4 class="card-title text-primary">{{$item['name']}}</h4>
                                        <h5>₫{{$item['price']}}</h5>
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
    </div>
</body>
</html>

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
    function filterOrdersByPrice(minPrice, maxPrice) {
        var allOrders = document.querySelectorAll('.order');
        var noProductMessage = document.getElementById('noProductMessage');
        var foundProducts = false;

        allOrders.forEach(function(order) {
            var orderPrice = parseFloat(order.getAttribute('data-price'));
            if ((orderPrice >= minPrice && orderPrice < maxPrice) || (minPrice === 'all' && maxPrice === 'all')) {
                order.style.display = 'block';
                foundProducts = true;
            } else {
                order.style.display = 'none';
            }
        });

        noProductMessage.style.display = foundProducts ? 'none' : 'block';
    }
</script>

@endsection
