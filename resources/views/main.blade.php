@include('layout.header')
<div class="container">
    <section class="home" id="home">
        <div class="row">
            <div class="left col-sm-6" data-aos="fade-right" data-aos-duration="1000">
                <img src="{{asset('images/mockup-graphics-1q4IIdEnIWA-unsplash-removebg-preview.png')}}" class="img-fluid" alt="">
            </div>
            <div class="right col-sm-6 align-self-center" data-aos="fade-left" data-aos-duration="1000">
                <h1 class="text-uppercase display-1 fw-bold" style="color: #ffffff;">gudang</h1>
                <h1 class="text-uppercase display-1 fw-bold" style="color: #D7BD94;">JAHE</h1>
                <p class="col-sm-8" style="color: #ffffff">
                    Gudang Jahe is a trusted destination for ginger lovers who are looking for the best 
                    quality and authentic benefits.
                </p>
            </div>
        </div>
    </section>
    <section class="about" id="about">
        <h1 class="text-uppercase display-6 fw-bold text-center" style="color: #ffffff;"><a style="color: #D7BD94">about</a> us</h1>
        <div class="row">
            <div class="left col-sm-6 d-flex justify-content-center align-self-center" data-aos="fade-up" data-aos-duration="1000">
                <p class="col-sm-8" style="color: #ffffff">We offer high quality ginger that has attracted the interest 
                of consumers both domestically and internationally. We recognize the importance of ginger as a commodity 
                rich in benefits and properties. Therefore, we are committed to providing the best ginger taken directly 
                from the source, by maintaining its freshness and ensuring that every product we offer provides unparalleled 
                added value for health and consumer satisfaction.</p>
            </div>
            <div class="right col-sm-5">
                <div class="image" data-aos="fade-down-right" data-aos-duration="1000">
                    <img src="{{asset('images/v50_56.png')}}" class="img-fluid" alt="">
                </div>
                <div class="images d-flex justify-content-end" data-aos="fade-down-left" data-aos-duration="1000">
                    <img src="{{asset('images/v31_19.png')}}" class="img-fluid" alt="">
                </div>
                <div class="image" data-aos="fade-down-right" data-aos-duration="1000">
                    <img src="{{asset('images/v31_20.png')}}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="product" id="product">
        <h1 class="text-uppercase display-6 fw-bold text-center" style="color: #ffffff;">Our <a style="color: #D7BD94">Product</a></h1>
        <div class="row gap-5 m-5 justify-content-center">
                @foreach ($produk as $produk)
                <div class="col col-md-auto" data-aos="flip-left" data-aos-duration="1000">
                    <img src="{{ asset('storage/'. $produk->gambar) }}" alt="">
                    <div class="item d-flex">
                        <p class="fw-bold flex-grow-1">{{$produk->nama}}</p>
                        <a href="{{ route('product', $produk->id) }}"><i class="fa fa-shopping-bag"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    <section class="testimoni" id="testimoni">
        <h1 class="text-uppercase display-6 fw-bold text-center" style="color: #ffffff;"><span style="color: #D7BD94">WHY</span> PEOPLE <span style="color: #D7BD94">BELIEVE</span> IN US</h1>
        <div class='container-fluid mx-auto mt-5 mb-5 col-12' style="text-align: center">
    <div class="row" style="justify-content: center">
        <div class="card col-md-3 col-12" data-aos="zoom-in" data-aos-duration="1000">
            <div class="card-content">
                <div class="card-body"> <i class="fa fa-star fa-2x"></i>
                    <div class="shadow"></div>
                    <div class="card-title"> premium-quality </div>
                    <div class="card-subtitle">
                        <p> 
                            <small class="text-muted">
                                People believe in us because our premium-quality ginger is sourced directly from trusted farmers,
                                 ensuring freshness and potency with every purchase.
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-md-3 col-12 ml-2" data-aos="zoom-in" data-aos-duration="1000">
            <div class="card-content">
                <div class="card-body"> <i class="fa fa-cart-arrow-down fa-2x"></i>
                    <div class="card-title"> Transparency </div>
                    <div class="card-subtitle">
                        <p> 
                            <small class="text-muted"> 
                            Our commitment to transparency and integrity in our 
                            sourcing and production processes instills confidence 
                            in our customers, making us a trusted choice for their ginger needs. 
                            </small> 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-md-3 col-12 ml-2" data-aos="zoom-in" data-aos-duration="1000">
            <div class="card-content">
                <div class="card-body"> <i class="fa fa-thumb-tack fa-2x"></i>
                    <div class="card-title"> Good Product </div>
                    <div class="card-subtitle">
                        <p> 
                            <small class="text-muted">
                                With a track record of delivering genuine health benefits 
                                and unbeatable flavor, our brand has earned the trust of 
                                countless individuals seeking the finest ginger products available.
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>
    <section class="gallery" id="gallery">
        <h1 class="text-uppercase display-6 fw-bold text-center"><a style="color: #D7BD94">Gallery</a></h1>
        <div class="container">
            <div class="row mt-5">
                <div class="col-sm-6 col-md-4 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <img src="{{asset('images/gudang.jpeg')}}" class="fluid img-thumbnail">      
                </div>
                <div class="col-sm-6 col-md-4 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <img src="{{asset('images/cuci.jpeg')}}" class="fluid img-thumbnail">      
                </div>
                <div class="col-sm-6 col-md-4 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <img src="{{asset('images/jahe.jpeg')}}" class="fluid img-thumbnail">      
                </div>
                <div class="col-sm-6 col-md-4 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <img src="{{asset('images/karung.jpeg')}}" class="fluid img-thumbnail">      
                </div>
                <div class="col-sm-6 col-md-4 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <img src="{{asset('images/suasana.jpeg')}}" class="fluid img-thumbnail">      
                </div>
                <div class="col-sm-6 col-md-4 mb-3" data-aos="fade-up" data-aos-duration="500">
                    <img src="{{asset('images/truk.jpeg')}}" class="fluid img-thumbnail">      
                </div>
            </div>
        </div>            
    </section>
    <section class="contact" id="contact">
        <h1 class="text-uppercase display-6 fw-bold text-center" style="color: #ffffff;">you want a <a style="color: #D7BD94">ginger</a><br><a style="color: #D7BD94">contact</a> us</h1>
        <div class="row justify-content-center">
            <div class="right col-md-auto" data-aos="fade-up-right" data-aos-duration="1000">
                <h6 class="text-white">Write to Us</h6>
                <a href=""><img src="{{asset('images/v50_36.png')}}" class="pb-4"></a>
                <h6 class="text-white">Call us the number</h6>
                <p class="pb-3">081259051602</p>
                <h6 class="text-white">Find us here</h6>
                <p>Jl. Raya Tambakrejo No.09,<br> Tambakrejo, Tambakasri, <br>Kec. Tajinan, Kabupaten Malang,<br> Jawa Timur 65172</p>
            </div>
            <div class="left col-md-auto" data-aos="fade-left" data-aos-duration="1000">
                <img src="{{asset('images/mockup-graphics-1q4IIdEnIWA-unsplash-removebg-preview.png')}}" class="img-fluid" alt="">
            </div>
        </div>
    </section>
</div>

@include('layout.footer')

