@extends('layouts.app')
@section('title', 'Accueil')

@section('content')

{{-- ===== Hero ===== --}}
<section class="hero mb-5 shadow-sm">
    <div class="row g-0 align-items-center">
        <div class="col-lg-7 p-4 p-md-5">
            <span class="badge rounded-pill bg-warning text-dark mb-3 px-3 py-2">
                <i class="bi bi-leaf"></i> 100% Naturel & Bio
            </span>
            <h1 class="display-5 fw-bold mb-3">
                Du champ à votre table.
            </h1>
            <p class="lead mb-4 opacity-90">
                Découvrez nos produits biologiques cultivés avec passion dans nos fermes
                agricoles. Fruits, légumes, miel, herbes et produits laitiers — tout est
                frais, local et certifié bio.
            </p>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('products.index') }}" class="btn btn-light btn-lg fw-semibold text-success">
                    <i class="bi bi-basket2-fill"></i> Voir les produits
                </a>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                        Créer un compte
                    </a>
                @endguest
            </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
            <div class="hero-img m-3"></div>
        </div>
    </div>
</section>

{{-- ===== Why us ===== --}}
<section class="mb-5">
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                <i class="bi bi-tree-fill text-success" style="font-size:2.5rem"></i>
                <h5 class="mt-3 fw-semibold">Bio Certifié</h5>
                <p class="text-muted small mb-0">Produits sans pesticides, cultivés naturellement.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                <i class="bi bi-truck text-success" style="font-size:2.5rem"></i>
                <h5 class="mt-3 fw-semibold">Livraison rapide</h5>
                <p class="text-muted small mb-0">De la ferme à votre porte en 24h.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                <i class="bi bi-heart-fill text-success" style="font-size:2.5rem"></i>
                <h5 class="mt-3 fw-semibold">Soutien local</h5>
                <p class="text-muted small mb-0">Vous soutenez directement les fermiers locaux.</p>
            </div>
        </div>
    </div>
</section>

{{-- ===== Featured Products ===== --}}
<section class="mb-4">
    <div class="d-flex justify-content-between align-items-end mb-3">
        <div>
            <h3 class="fw-bold mb-1">Produits en vedette</h3>
            <p class="text-muted mb-0 small">Sélection fraîche de nos fermes partenaires.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-success">
            Voir tout <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-md-3">
                <div class="card product-card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=400&q=70" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body">
                        <span class="category-chip">{{ $product->category }}</span>
                        <h5 class="card-title mt-2 mb-1">{{ $product->name }}</h5>
                        <div class="price-tag">{{ number_format($product->price, 2) }} €</div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Aucun produit pour le moment.</p>
        @endforelse
    </div>
</section>

@endsection
