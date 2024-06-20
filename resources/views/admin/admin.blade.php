<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gudang Jahe</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="icon" href="{{asset('images/v21_13.png')}}" type="image/icon type">
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/font-awesome-4.7.0/css/font-awesome.css')}}">
</head>
<body>
    <!-- =============== Navigation ================ -->
            <div class="navigation">
                <ul>
                    <li>
                        <a href="{{route('admin')}}">
                            <span class="icon">
                                <img src="{{asset('images/v21_13.png')}}" alt="">
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="/dashboard">
                            <span class="icon">
                                <i class="fa fa-home fa-2x"></i>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                <li>
                    <a href="/user">
                        <span class="icon">
                            <i class="fa fa-user fa-2x"></i>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="/produk">
                        <span class="icon">
                            <i class="fa fa-dropbox fa-2x"></i>
                        </span>
                        <span class="title">Products</span>
                    </a>
                </li>
                <li>
                    <a href="/orders">
                        <span class="icon">
                            <i class="fa fa-cart-plus fa-2x"></i>
                        </span>
                        <span class="title">Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('logout')}}">
                        <span class="icon">
                            <i class="fa fa-sign-out fa-2x"></i>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <i class="fa fa-bars"></i>
                </div>

                <h1 style="color: white">@yield('title')</h1>
                {{-- <div class="user">
                    <p>Welcome {{ Auth::user()->role }}</p>
                </div> --}}
            </div>
            @yield('content')
        </div>

    <!-- =========== Scripts =========  -->
    <script src="{{asset('js/main.js')}}"></script>
</body>
