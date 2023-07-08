@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <span class="text-danger">New Order : {{ $newOrder }}</span> ;
                    <span class="text-success">Payment Success : {{ $paymentSuccess }}</span> ;
                    <span>Order Success : {{ $orderSuccess }}</span> ;
                    <span class="text-info">Order Complete : {{ $orderComplete }}</span> ;
                    <span class="text-danger">Order Cancel : {{ $orderCancel }}</span> ;
                    <span class="text-success">Payment Pending : {{ $paymentPendding }}</span> ;
                    <span>Payment Failed : {{ $paymentFailed }}</span> ;
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b>Order Detal</b></label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetail as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <label for=""><b>Customer</b></label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer as $item)
                                    <tr>
                                        <td>{{ $item->user->first_name }}</td>
                                        <td>{{ $item->order_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br><br><br>
                        <div class="col-md-6">
                            <label for=""><b>Agent Customer</b></label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Agent Name</th>
                                        <th>Amount Customer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agent as $item)
                                    <tr>
                                        <td>{{ $item->store_name }}</td>
                                        <td>{{ $item->customer_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
