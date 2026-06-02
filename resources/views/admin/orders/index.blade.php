@extends('layouts.admin')
@section('title', 'Orders')

@section('content')
<h2 class="mb-3">All Orders</h2>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $o)
                    <tr>
                        <td>{{ $o->id }}</td>
                        <td>{{ $o->customer_name }}<br><small class="text-muted">{{ $o->customer_email }}</small></td>
                        <td>${{ number_format($o->total, 2) }}</td>
                        <td>
                            <span class="badge {{ $o->payment_status == 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($o->payment_status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($o->order_status) }}</span>
                        </td>
                        <td>{{ $o->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $o->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3 d-flex justify-content-center">{{ $orders->links() }}</div>
@endsection
