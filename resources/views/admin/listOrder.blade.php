@extends('admin.admin')
@section('title', 'Order')

@section('content')
<div class="order">
        <div class="recentOrders">
            <table>
                <thead>
                    <tr>
                        <td>Orders#</td>
                        <td>Customer</td>
                        <td>Email</td>
                        {{-- <td>Phone</td> --}}
                        <td>Status</td>
                        <td>Total</td>
                        <td>Date Purchased</td>
                        <td>Method</td>
                        <td>Payment Status</td>
                        <td>Details</td>
                    </tr>
                </thead>

                <tbody>
                    @if ($orders->isNotEmpty())
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->nama }}</td>
                                <td>{{ $order->email }}</td>
                                {{-- <td>{{ $order->phone }}</td> --}}
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
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                <td>{{ $order->metode }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>
                                    <a href="{{route('ordersDetail',[$order->id])}}" type="button" class="btn btn-success btn-just-icon btn-sm edit-btn">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
</div>

@endsection
