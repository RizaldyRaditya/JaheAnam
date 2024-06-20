@include('layout.header')
<div class="container text-white mt-5">
      <div class="row">
          <div class="col-md-4 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span>Your cart</span>
                  <span class="badge badge-secondary badge-pill">{{ Cart::content()->count() }}</span>
                </h4>
                <ul class="list-group mb-3">
                @foreach (Cart::content() as $item)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <h6 class="my-0">{{ $item->name }} ({{ $item->qty }} Kg) </h6>
                    <span class="text-muted">Rp. {{ $item->price }}</span>
                </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (Rp)</span>
                    <strong>Rp. {{ Cart::subtotal() }}</strong>
                </li>
                </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form id="orderForm" name="orderForm" action="" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name">Nama</label>
              <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
              <div class="invalid-feedback">
                Nama
              </div>
            </div>
            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="alamat">alamat</label>
              <input type="text" class="form-control" name="alamat" id="alamat" >
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="notelp">no telp</label>
              <input type="text" class="form-control" name="notelp" id="notelp" >
              <div class="invalid-feedback">
                Please enter your number.
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" name="kota" placeholder="" >
                <div class="invalid-feedback">
                  Kota required.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="kecamatan">Kecamatan</label>
                <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="" >
                <div class="invalid-feedback">
                  kecamatan required.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="kodepos">Kode Pos</label>
                <input type="text" class="form-control" name="kodepos" id="kodepos" placeholder="" >
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="cod" name="paymentMethod" type="radio" value="cod" class="custom-control-input" >
                <label class="custom-control-label" for="cod">COD</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="transfer" name="paymentMethod" type="radio" value="transfer" class="custom-control-input" >
                <label class="custom-control-label" for="transfer">Transfer</label>
              </div>
            </div>

            <hr class="mb-5 mt-5">
            <button class="btn btn-dark btn-lg btn-block" type="submit">Place your orders</button>
          </form>
        </div>
      </div>

@include('layout.footer')


<script type="text/javascript">
    $("#orderForm").submit(function(event){
        event.preventDefault();
        $.ajax({
          url: '{{ route("processCheckout") }}',
          type: 'post',
          data: $(this).serializeArray(),
          dataType: 'json',
          success: function(response){
            if (response.status == true) {
              // Arahkan pengguna ke halaman keranjang hanya jika permintaan berhasil
              window.location.href= '{{route("myorder")}}';
            } else {
                alert(response.message);
            }
          },
        });
    })
</script>

