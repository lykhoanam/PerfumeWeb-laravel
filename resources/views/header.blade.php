   <?php
    use App\Http\Controllers\ProductController;

    $productController = app(ProductController::class);
    $total = $productController->cartItem();
    ?>

    <nav class="navbar navbar-default navbar-fixed-top">


            <div class="navbar-header col-md-4">
                <button class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color:black" href="/product">LKN Perfume</a>
            </div>

            <div class="collapse navbar-collapse col-lg-8 col-md-8" id="mainNav">

                <ul class="nav navbar-nav mr-auto">
                    <li class="{{ Request::is('forher') ? 'active' : '' }}"><a href="/forher">FOR HER</a></li>
                    <li class="{{ Request::is('forhim') ? 'active' : '' }}"><a href="/forhim">FOR HIM</a></li>
                    <li class="{{ Request::is('unisex') ? 'active' : '' }}"><a href="/unisex">UNISEX</a></li>
                    <li class="{{ Request::is('giftset') ? 'active' : '' }}"><a href="/giftset">GIFT SET</a></li>
                </ul>

                <form action="/search" class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" name="query" placeholder="Search....">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/cartlist">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            <span class="cart-quantity">{{ $total }}</span>
                        </a>
                    </li>
                    @if(Session::has('user'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span> {{ Session::get('user')['name'] }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/myorder"><span class="glyphicon glyphicon-list-alt"></span> Hồ sơ</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span> Account <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
                                <li><a href="/signup"><span class="glyphicon glyphicon-pencil"></span> Đăng ký</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>

    </nav>


