<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Bio Farms Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-success: #386641;
            --bs-success-rgb: 56, 102, 65;
            --brand-light: #6a994e;
            --brand-cream: #fefae0;
        }
        body { font-family: 'Poppins', system-ui, sans-serif; background:#f3f4f1; }
        .bg-success { background-color: var(--bs-success) !important; }
        .btn-success { background-color: var(--bs-success); border-color: var(--bs-success); }
        .btn-success:hover { background-color: var(--brand-light); border-color: var(--brand-light); }
        .text-success { color: var(--bs-success) !important; }
        .navbar.bg-dark { background-color: #2c5e3a !important; }
        .card { border: none; border-radius: 14px; }
        .stat-card { transition: transform .2s; }
        .stat-card:hover { transform: translateY(-3px); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-shield-lock-fill"></i> Bio Farms Admin
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            @auth('admin')
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Tableau de bord</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}"><i class="bi bi-box-seam"></i> Produits</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="bi bi-receipt"></i> Commandes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.admins.index') }}"><i class="bi bi-people"></i> Admins</a></li>
            </ul>
            <ul class="navbar-nav align-items-lg-center">
                <li class="nav-item me-2">
                    <span class="navbar-text text-white">
                        <i class="bi bi-person-circle"></i> {{ Auth::guard('admin')->user()->name }}
                    </span>
                </li>
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </button>
                    </form>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-house"></i></a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>

<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm"><i class="bi bi-exclamation-circle"></i> {{ session('error') }}</div>
    @endif
</div>

<main class="container my-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
