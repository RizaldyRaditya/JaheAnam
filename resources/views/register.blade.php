<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gudang Jahe</title>
    <link rel="icon" href="{{asset('images/v21_13.png')}}" type="image/icon type">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
</head>
<body style="background-color: black">
    <h1 class="text-center" style="color: #d7bd94; margin-top: 50px">Register</h1>
    <div class="wrapper-register" data-aos="flip-left"
    data-aos-easing="ease-out-cubic"
    data-aos-duration="1000">
        <div class="logo">
            <img src="{{asset('images/mockup-graphics-1q4IIdEnIWA-unsplash-removebg-preview.png')}}" alt="">
        </div>
        <form class="p-3" action="{{url('check_register')}}" method="POST">
        @csrf
            <div class="form-field d-flex align-items-center">
                <span class="fa fa-user"></span>
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fa fa-key"></span>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <button class="btn mt-3 text-black">Register</button>
        </form>
        <div class="text-center fs-6">
            <span>Already have account?</span><a href="{{route('login')}}"> Login</a>
        </div>
        <div class="form-group col-lg-12 mx-auto d-flex align-items-center justify-content-center mt-4 mb-2">
            <div class="border-bottom border-dark w-25 ml-5"></div>
            <span class="px-2 small text-muted fw-bold text-muted">Sign up With</span>
            <div class="border-bottom border-dark w-25 mr-5"></div>
        </div>
        <a href="{{route('googlelogin')}}"><img src="{{asset('images/search.png')}}" style="width: 15px;" class="col-lg-12 mx-auto d-flex align-items-center justify-content-center"></a>
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
