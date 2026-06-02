@extends('layouts.app')
@section('title', 'Panier')

@section('content')
<h2 class="fw-bold mb-4"><i class="bi bi-cart3"></i> Votre panier</h2>

@if(empty($cart))
    <div class="card border-0 shadow-sm rounded-4 text-center p-5">
        <i class="bi bi-cart-x text-muted" style="font-size:3rem"></i>
        <h5 class="mt-3">Votre panier est vide</h5>
        <p class="text-muted">Découvrez nos produits frais et bio.</p>
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-success">
                <i class="bi bi-basket2"></i> Voir les produits
            </a>
        </div>
    </div>
@else
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th style="width: 180px;">Quantité</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if(!empty($item['image']))
                                                <img src="{{ asset('storage/'.$item['image']) }}" style="width:48px;height:48px;object-fit:cover;border-radius:8px">
                                            @else
                                                <div class="bg-light rounded" style="width:48px;height:48px"></div>
                                            @endif
                                            <span class="fw-semibold">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td>{{ number_format($item['price'], 2) }} €</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.update', $id) }}" class="d-flex">
                                            @csrf
                                            <input type="number" name="quantity" min="1" value="{{ $item['quantity'] }}" class="form-control form-control-sm me-2">
                                            <button class="btn btn-sm btn-outline-success">OK</button>
                                        </form>
                                    </td>
                                    <td><strong class="text-success">{{ number_format($item['price'] * $item['quantity'], 2) }} €</strong></td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', $id) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash"></i> Vider le panier
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 1rem;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Résumé</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Sous-total</span>
                        <span>{{ number_format($grandTotal, 2) }} €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Livraison</span>
                        <span class="text-success">Gratuite</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong class="text-success fs-5">{{ number_format($grandTotal, 2) }} €</strong>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-success w-100 py-2 fw-semibold">
                        Passer commande <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
