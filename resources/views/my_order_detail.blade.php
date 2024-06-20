@include('layout.header')

<section class="my_order_detail mt-5">
    <div class="container">
        <a href="{{ route('myorder') }}" class="btn" style="background-color: #d7bd94">
            Back
        </a>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pt-3">
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <h1 class="h5 mb-3">Shipping Address</h1>
                                <address>
                                    <strong>{{ $order->nama }}</strong><br>
                                    {{ $order->alamat }}<br>
                                    {{ $order->kota }}, {{ $order->kecamatan }}, {{ $order->kodepos }}<br>
                                    {{ $order->notelp }}<br>
                                    {{ $order->email }}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <br>
                                <b>Order ID:</b> {{ $order->id }}<br>
                                <b>Total:</b> Rp. {{ number_format($order->subtotal) }}<br>
                                <b>Status:</b>
                                @if ($order->status == 'pending')
                                    <span class="text-warning">{{ $order->status }}</span>
                                @elseif ($order->status == 'inprogress')
                                    <span class="text-primary">{{ $order->status }}</span>
                                @elseif ($order->status == 'delivered')
                                    <span class="text-success">{{ $order->status }}</span>
                                @else
                                    <span class="text-danger">{{ $order->status }}</span>
                                @endif
                                <br>
                                <b>Metode: </b> {{ $order->metode }}<br>
                                <b>Paymet Status: </b> {{ $order->payment_status }}<br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th width="100">Price</th>
                                    <th width="100">Qty</th>
                                    <th width="100">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $orderItem)
                                    <tr>
                                        <td>{{ $orderItem->name }}</td>
                                        <td>{{ number_format($orderItem->price) }}</td>
                                        <td>{{ $orderItem->qty }}</td>
                                        <td>{{ number_format($orderItem->total) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="3" class="text-right">Subtotal:</th>
                                    <td>{{ number_format($order->subtotal) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-grid d-md-flex justify-content-md-end"> 
                            @if ($order->metode == 'transfer')
                                @if ($order->payment_status == 'not paid')
                                    @if ($order->status == 'pending')
                                        <button type="button" class="btn edit-btn" data-orderid="{{ $order->id }}" style="background-color: #e4d1b3">
                                            $ Pay
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-danger disabled">
                                            canceled
                                        </button>
                                    @endif
                                @else
                                    <button type="button" class="btn btn-success disabled">
                                        paid
                                    </button>
                                @endif
                            @else
                                <button type="button" class="btn btn-primary disabled">
                                    COD
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.client_key')}}"></script>
<script type="text/javascript">
   $(document).ready(function() {
    $(".edit-btn").click(function(event) {
        event.preventDefault();
        var orderId = $(this).data('orderid'); // Ambil ID pesanan
        // Mendapatkan CSRF token dari meta tag
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '{{ route("processCheckoutTransfer") }}',
            type: 'post',
            data: {
                _token: token,
                order_id: orderId
            },
            dataType: 'json',
            success: function(response) {
                var snapToken = response.snapToken;
                if (snapToken) {
                    window.snap.pay(snapToken, {
                        onSuccess: function(result) {
                            alert("payment success!");
                            // Mengirim permintaan untuk memperbarui status pembayaran
                            $.ajax({
                                url: '{{ route("updatePaymentStatus") }}',
                                type: 'post',
                                data: {
                                    _token: token,
                                    order_id: orderId // Menggunakan ID pesanan yang sesuai
                                },
                                dataType: 'json',
                                success: function(response) {
                                    // Handle response jika diperlukan
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    alert("An error occurred while updating payment status.");
                                }
                            });
                            window.location.href = '{{route("myorder")}}';
                        },
                        onPending: function(result) {
                            alert("waiting your payment!");
                            window.location.href = '{{route("myorder")}}';
                        },
                        onError: function(result) {
                            alert("payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            alert('you closed the popup without finishing the payment');
                            window.location.href = '{{route("myorder")}}';
                        }
                    });
                } else {
                    alert("Snap token not found!");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while processing your request. Please try again later.");
            }
        });
    });
});


</script>
