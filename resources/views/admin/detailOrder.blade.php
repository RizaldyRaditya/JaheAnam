@extends('admin.admin')
@section('title', 'DetailOrder')

@section('content')
    <div class="detailorder">
        <a href="{{ route('orders') }}">
            <i class="fa fa-arrow-left m-3"> Back</i>
        </a>
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
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
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <form action="{{ route('changeOrderStatus', $order->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <h2 class="h4 mb-3">Order Status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="inprogress" {{ $order->status == 'inprogress' ? 'selected' : '' }}>
                                            inprogress</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                            Delivered</option>
                                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>
                                            canceled</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="date" name="shipped_date" id="shipped_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        @if ($order->metode == 'cod')
                        <form action="{{ route('changePayment', $order->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <h2 class="h4 mb-3">Payment Status</h2>
                                <div class="mb-3">
                                    <select name="paymentStatus" id="paymentStatus" class="form-control">
                                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="not paid" {{ $order->status == 'not paid' ? 'selected' : '' }}>Not Paid</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
