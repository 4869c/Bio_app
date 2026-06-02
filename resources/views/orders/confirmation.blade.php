@extends('layouts.app')
@section('title', 'Confirmation')

@section('content')
<div class="text-center mb-4">
    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 mb-3"
         style="width:90px;height:90px">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
    </div>
    <h2 class="fw-bold">Paiement réussi !</h2>
    <p class="lead text-muted">Votre commande a été passée avec succès.</p>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-success text-white rounded-top-4">
        <h5 class="mb-0 fw-bold">Commande #{{ $order->id }}</h5>
    </div>
    <div class="card-body p-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted small text-uppercase">Client</h6>
                <strong>{{ $order->customer_name }}</strong><br>
                <small>{{ $order->customer_email }}</small><br>
                <small>{{ $order->customer_phone ?? '-' }}</small>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted small text-uppercase">Livraison</h6>
                {{ $order->customer_address }}<br>
                <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small><br>
                <span class="badge bg-info">{{ ucfirst($order->order_status) }}</span>
                <span class="badge bg-success">{{ ucfirst($order->payment_status) }}</span>
            </div>
        </div>

        <h6 class="fw-bold mb-3">Produits commandés</h6>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ number_format($item->unit_price, 2) }} €</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->subtotal, 2) }} €</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-success">
                        <th colspan="3" class="text-end">Total</th>
                        <th class="fs-5">{{ number_format($order->total, 2) }} €</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-success px-4">
                <i class="bi bi-basket"></i> Continuer mes achats
            </a>
        </div>
    </div>
</div>
@endsection
