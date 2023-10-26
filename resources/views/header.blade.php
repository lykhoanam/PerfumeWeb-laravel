<?php
use App\Http\Controllers\ProductController;

$productController = app(ProductController::class);
$total = $productController->cartItem();


?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">

        <div class="navbar-header col-md-4">
            <button class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/product">LKN perfume</a>
        </div>

        <div class="collapse navbar-collapse col-lg-8 col-md-8" >
            <form action="/search" class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" name="query" style="width:700px;" placeholder="Search....">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/cartlist">
                        <span style="font-size:100%;" class="glyphicon glyphicon-shopping-cart"></span>
                        <span class="cart-quantity">{{$total}}</span>
                    </a>
                </li>
                @if(Session::has('user'))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span> {{Session::get('user')['name']}}<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Hồ sơ cá nhân</a></li>
                        <li><a href="/myorder"><span class="glyphicon glyphicon-pencil"></span> Đơn mua</a></li>
                        <hr>
                        <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
                    </ul>
                </li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
                        <li><a href="/signup"><span class="glyphicon glyphicon-pencil"></span> Đăng ký</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul id="navlist" class="nav nav-justified">
                        <li><a href="/forher">FOR HER</a></li>
                        <li><a href="/forhim">FOR HIM</a></li>
                        <li><a href="/unisex">UNISEX</a></li>
                        <li><a href="/giftset">GIFT SET</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</nav>
