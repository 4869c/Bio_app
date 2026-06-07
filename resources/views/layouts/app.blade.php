<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bio Shop') | Bio Farms</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bs-success: #386641;
            --bs-success-rgb: 56, 102, 65;
            --bs-warning: #bc6c25;
            --bs-warning-rgb: 188, 108, 37;
            --brand-light: #6a994e;
            --brand-cream: #fefae0;
        }
        body {
            font-family: 'Poppins', system-ui, sans-serif;
            background: #f7f6f1;
        }
        .bg-success { background-color: var(--bs-success) !important; }
        .btn-success {
            background-color: var(--bs-success);
            border-color: var(--bs-success);
        }
        .btn-success:hover, .btn-success:focus {
            background-color: var(--brand-light);
            border-color: var(--brand-light);
        }
        .text-success { color: var(--bs-success) !important; }
        .badge.bg-success { background-color: var(--bs-success) !important; }

        .navbar-brand-bio {
            font-weight: 700;
            letter-spacing: .3px;
        }
        .navbar .nav-link { font-weight: 500; }
        .navbar .nav-link:hover { color: var(--brand-cream) !important; }

        .hero {
            background: linear-gradient(135deg, #386641 0%, #6a994e 100%);
            color: #fff;
            border-radius: 1rem;
            overflow: hidden;
        }
        .hero-img {
            background-image: url('https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=900&q=70');
            background-size: cover;
            background-position: center;
            min-height: 280px;
            border-radius: 1rem;
        }

        .product-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 .75rem 1.5rem rgba(56,102,65,.15);
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
        }
        .price-tag {
            color: var(--bs-success);
            font-weight: 700;
            font-size: 1.15rem;
        }
        .category-chip {
            background: var(--brand-cream);
            color: #6b4a17;
            border: 1px solid #ead7a4;
            border-radius: 999px;
            padding: .25rem .65rem;
            font-size: .75rem;
            font-weight: 600;
        }

        footer.bio-footer {
            background: #2c5e3a;
            color: #e9efe7;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: var(--bs-success);">
    <div class="container">
        <a class="navbar-brand navbar-brand-bio d-flex align-items-center gap-2" href="{{ route('home') }}">
            <i class="bi bi-tree-fill fs-4"></i>
            <span>Bio Farms</span>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="bi bi-house-door"></i> Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}"><i class="bi bi-basket2"></i> Produits</a></li>
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart3"></i> Panier
                        @php $cartCount = array_sum(array_column(session('cart', []), 'quantity')); @endphp
                        @if($cartCount > 0)
                            <span class="badge rounded-pill bg-warning text-dark">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-lg-center">
                @auth
                    <li class="nav-item me-2">
                        <span class="navbar-text text-white">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
                    <li class="nav-item">
                        <a class="btn btn-light btn-sm text-success fw-semibold ms-lg-2" href="{{ route('register') }}">
                            S'inscrire
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<main class="container my-4">
    @yield('content')
</main>

<footer class="bio-footer mt-5 pt-4 pb-3">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <h5 class="fw-bold mb-2"><i class="bi bi-tree-fill"></i> Bio Farms</h5>
                <p class="small mb-0">
                    Produits biologiques frais issus directement de nos fermes agricoles.
                    Qualité, traçabilité et respect de la nature.
                </p>
            </div>
            <div class="col-md-3">
                <h6 class="fw-semibold">Navigation</h6>
                <ul class="list-unstyled small mb-0">
                    <li><a class="text-light text-decoration-none" href="{{ route('home') }}">Accueil</a></li>
                    <li><a class="text-light text-decoration-none" href="{{ route('products.index') }}">Produits</a></li>
                    <li><a class="text-light text-decoration-none" href="{{ route('cart.index') }}">Panier</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-semibold">Contact</h6>
                <p class="small mb-0">
                    <i class="bi bi-geo-alt"></i> Ferme Bio, Maroc<br>
                    <i class="bi bi-envelope"></i> contact@biofarms.ma
                </p>
            </div>
        </div>
        <hr class="border-light opacity-25">
        <div class="text-center small opacity-75">
            &copy; {{ date('Y') }} Bio Farms - Projet académique
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
