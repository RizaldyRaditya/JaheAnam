@extends('admin.admin')
@section('title', 'Dashboard')

@section('content')
            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $totalUsers }}</div>
                        <div class="cardName">Total User</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ $totalProduks }}</div>
                        <div class="cardName">Produk</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{$totalOrders}}</div>
                        <div class="cardName">Total Order</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">Rp. {{ number_format($totalRevenue) }}</div>
                        <div class="cardName">Earning</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Orders</h2>
                        <a href="{{ route('orders') }}" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Payment</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($orders->isNotEmpty())
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->nama }}</td>
                                        <td>Rp. {{ number_format($order->subtotal) }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="status pending">Pending</span>
                                            @elseif ($order->status == 'inprogress')
                                                <span class="status inProgress">In Progress</span>
                                            @elseif ($order->status == 'delivered')
                                                <span class="status delivered">Delivered</span>
                                            @else
                                                <span class="status canceled">Canceled</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent Customers</h2>
                    </div>

                    <table>
                        @foreach ($user as $user)
                        <tr>
                            <td>
                                <h4>{{$user->name}} <br><span>{{$user->email}}</span></h4>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

@endsection
