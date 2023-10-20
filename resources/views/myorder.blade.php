<!-- cartlist.blade.php -->
@extends('master')
@section('content')


    <body>

    <div class="container">
        <div class="row">
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th>Created ad</th>
                            <th>ID Product</th>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                            <tr>
                                <td class="vertical">{{ $item->purchase_date }}</td>
                                <td class="vertical">{{ $item->id }}</td>
                                <td class="vertical"><img class="thumbnail-image" src="{{ asset($item->gallery) }}" alt="{{ $item->name }}"></td>
                                <td class="vertical">{{ $item->name }}</td>
                                <td class="vertical">{{ $item->quantity }}</td>
                                <td class="vertical">₫{{ $item->price }}</td>
                                <td class="vertical">₫{{ $item->price * $item->quantity }}</td>
                                <td class="vertical">{{ $item->status }}</td>
                                <td class="vertical">{{ $item->payment_method }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

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



    </body>







@endsection
