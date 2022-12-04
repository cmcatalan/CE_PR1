<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Gourmand store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest')}}">
    <link rel="stylesheet" href="{{ asset('assets/third-parties/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body>
<div class="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Gourmand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="/">Categories</a></li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        @php $total_items = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total_items += $details['quantity'] @endphp
                        @endforeach
                        <span class="badge bg-dark text-white ms-1 rounded-pill">
                            {{ $total_items }}
                        </span>
                    </button>
                    <div class="dropdown-menu p-2" style="width: 200px;max-width: 200px;">

                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total += ($details['is_sale'] ? $details['sale_price'] : $details['price']) * $details['quantity'] @endphp
                        @endforeach
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <div class="row mb-2">
                                    <div class="col-4 text-center">
                                        <img src="{{ asset('assets/img')}}{{ $details['image_path'] }}"
                                             alt="{{$details['name']}}" width="32"/>
                                    </div>
                                    <div class="col-8 text-end">
                                        <p class="mb-0"
                                           style="white-space: nowrap;overflow:hidden;text-overflow: ellipsis;font-size:12px;">
                                            {{ $details['name'] }}
                                        </p>
                                        <span class="badge text-bg-dark">
                                            {{ ($details['is_sale'] ? $details['sale_price'] : $details['price']) }}€
                                        </span>
                                        <span style="font-size:12px;"> Qty:</span>
                                        <span> {{ $details['quantity'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <p class="text-end">Total: <span class="badge text-bg-dark">{{ $total }}€</span></p>
                        <div class="text-center">
                            <a href="/cart" class="btn btn-sm btn-dark btn-block">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @yield('content')
</div>

<footer class="footer bg-dark">
    <div class="container">
        <div class=" d-flex flex-wrap justify-content-between align-items-center py-2 my-4">
            <p class="font-sm text-white">
                <img alt="Barcelona icon" src="{{ asset('assets/img/bcn.png')}}"/>
                Made in Barcelona
            </p>
            <p class="text-md-end text-start font-sm text-white">Miguel Catalán</p>
        </div>
    </div>
</footer>
<script src="{{ asset('assets/third-parties/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/js/main.js')}}"></script>
</body>

</html>
