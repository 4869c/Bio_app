@extends('layouts.admin')
@section('title', 'Order #'.$order->id)

@section('content')
<a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Back to orders
</a>

<h2>Order #{{ $order->id }}</h2>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Customer</div>
            <div class="card-body">
                <strong>Name:</strong> {{ $order->customer_name }}<br>
                <strong>Email:</strong> {{ $order->customer_email }}<br>
                <strong>Phone:</strong> {{ $order->customer_phone ?? '-' }}<br>
                <strong>Address:</strong> {{ $order->customer_address }}<br>
                <strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Update Status</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <select name="payment_status" class="form-select">
                            @foreach(['paid','unpaid','refunded'] as $s)
                                <option value="{{ $s }}" {{ $order->payment_status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order Status</label>
                        <select name="order_status" class="form-select">
                            @foreach(['pending','processing','delivered','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $order->order_status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Items</div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>${{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-success">
                    <th colspan="3" class="text-end">Total</th>
                    <th>${{ number_format($order->total, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
