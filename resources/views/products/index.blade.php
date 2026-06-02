@extends('layouts.app')
@section('title', 'Produits')

@section('content')
<div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
    <div>
        <h2 class="fw-bold mb-1">Nos produits bio</h2>
        <p class="text-muted mb-0 small">
            {{ $products->total() }} produit(s) disponible(s)
        </p>
    </div>
</div>

{{-- ===== Filters ===== --}}
<form method="GET" action="{{ route('products.index') }}" class="card border-0 shadow-sm rounded-4 p-3 mb-4">
    <div class="row g-2">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Rechercher un produit...">
            </div>
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="min_price" value="{{ request('min_price') }}" class="form-control" placeholder="Prix min €">
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="max_price" value="{{ request('max_price') }}" class="form-control" placeholder="Prix max €">
        </div>
        <div class="col-md-1 d-grid">
            <button class="btn btn-success"><i class="bi bi-funnel"></i></button>
        </div>
    </div>
    @if(request()->hasAny(['search','category','min_price','max_price']))
        <div class="mt-2">
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-link text-muted text-decoration-none">
                <i class="bi bi-x-circle"></i> Réinitialiser les filtres
            </a>
        </div>
    @endif
</form>

{{-- ===== Products ===== --}}
<div class="row g-4">
    @forelse($products as $product)
        <div class="col-md-4 col-lg-3">
            <div class="card product-card h-100 shadow-sm position-relative">
                @if($product->quantity < 1)
                    <span class="badge bg-danger position-absolute top-0 end-0 m-2">Rupture</span>
                @elseif($product->quantity < 10)
                    <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">Stock limité</span>
                @endif

                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=400&q=70" alt="{{ $product->name }}">
                @endif

                <div class="card-body d-flex flex-column">
                    <span class="category-chip align-self-start">{{ $product->category }}</span>
                    <h5 class="card-title mt-2 mb-1">{{ $product->name }}</h5>
                    <p class="card-text text-muted small flex-grow-1">
                        {{ \Illuminate\Support\Str::limit($product->description, 70) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="price-tag">{{ number_format($product->price, 2) }} €</span>
                        <small class="text-muted">
                            <i class="bi bi-box-seam"></i> {{ $product->quantity }}
                        </small>
                    </div>

                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button class="btn btn-success w-100" @if($product->quantity < 1) disabled @endif>
                            <i class="bi bi-cart-plus"></i> Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm rounded-4 text-center py-4">
                <i class="bi bi-search fs-3 d-block mb-2"></i>
                Aucun produit ne correspond à votre recherche.
            </div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $products->links() }}
</div>
@endsection
