@include('layout.header')

<section class="detail_produk mt-5" id="detail_produk">
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="{{ asset('storage/'. $product->gambar) }}" class="rounded mx-auto d-block" alt="">
            </div>
            <div class="col">
                <h1 class="fw-bold display-1">{{$product->nama}}</h1>
                <h4 class="text-white mt-3">Rp. {{$product->harga}}</h4>
                <p class="text-white">Stok: {{ $product->stok }} Kg</p>
                <p class="text-white mt-5">{{$product->deskripsi}}</p>
                <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})" class="btn btn-dark px-5" type="button">
                    Add To Cart
                </a>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function addToCart(id){
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '{{route("addToCart")}}',
        type: 'post',
        data: {
            id:id,
            _token: csrfToken
        },
        dataType: 'json',
        success: function(response){
            if (response.status == true) {
                // Arahkan pengguna ke halaman keranjang hanya jika permintaan berhasil
                window.location.href= '{{route("cart")}}';
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            // Tampilkan pesan error jika permintaan gagal
            alert("Error: " + error);
        }
    });
}


</script>


