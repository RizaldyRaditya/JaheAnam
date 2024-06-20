@include('layout.header')
<section class="myorder mt-5" id="myorder">
    <div class="container">
        <h1 class="fw-bold display-2 text-center" style="color: #d7bd94">My Order</h1>
        @if ($orders->count() > 0)
        <table>
            <thead>
                <tr>
                    <td>Orders</td>
                    <td>Date Purchased</td>
                    <td>Status</td>
                    <td>Total</td>
                    <td>Action</td>
                </tr>
            </thead>

            <tbody>
                @if ($orders->isNotEmpty())
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                            <td>
                                @if ($order->status == 'pending')
                                    <span class="status pending">Pending</span>
                                @elseif ($order->status == 'inprogress')
                                    <span class="status inProgress">InProgress</span>
                                @elseif ($order->status == 'delivered')
                                    <span class="status delivered">Delivered</span>
                                @else
                                    <span class="status canceled">Canceled</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($order->subtotal) }}</td>
                            <td>
                                <a href="{{route('myorder_detail',[$order->id])}}" class="btn btn-just-icon btn-sm" style="background-color: #e4d1b3">
                                    <i class="fa fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @else
        <div class="col-md-12">
            <div class="card" style="background-color: #d7bd94">
                <div class="card-body d-flex justify-content-center" >
                    <h4>Your Order is Empty!</h4>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>



