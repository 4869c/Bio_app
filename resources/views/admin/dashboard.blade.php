@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('content')
<h2 class="fw-bold mb-4">Tableau de bord</h2>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card shadow-sm text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="opacity-75">Produits</small>
                        <h2 class="mb-0 fw-bold">{{ $stats['products'] }}</h2>
                    </div>
                    <i class="bi bi-box-seam fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card shadow-sm text-white" style="background:#2c5e3a">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="opacity-75">Commandes</small>
                        <h2 class="mb-0 fw-bold">{{ $stats['orders'] }}</h2>
                    </div>
                    <i class="bi bi-receipt fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card shadow-sm text-white" style="background:#6a994e">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="opacity-75">Clients</small>
                        <h2 class="mb-0 fw-bold">{{ $stats['users'] }}</h2>
                    </div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card shadow-sm text-white bg-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="opacity-75">Admins</small>
                        <h2 class="mb-0 fw-bold">{{ $stats['admins'] }}</h2>
                    </div>
                    <i class="bi bi-shield-lock fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card stat-card shadow-sm text-white" style="background:linear-gradient(90deg,#bc6c25,#e0863a)">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">Chiffre d'affaires (payé)</small>
                    <h2 class="mb-0 fw-bold">{{ number_format($stats['revenue'], 2) }} €</h2>
                </div>
                <i class="bi bi-cash-stack fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2 flex-wrap">
    <a href="{{ route('admin.products.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Ajouter un produit</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-success">Gérer les produits</a>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-dark">Voir les commandes</a>
    <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-dark">Gérer les admins</a>
</div>
@endsection
