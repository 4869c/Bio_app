@extends('layouts.app')
@section('title', 'Commande')

@section('content')
<h2 class="fw-bold mb-4"><i class="bi bi-bag-check"></i> Finaliser la commande</h2>

<div class="row g-4">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Informations client</h5>

                @if($errors->any())
                    <div class="alert alert-danger border-0">
                        @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('checkout.process') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nom complet</label>
                        <input type="text" name="customer_name" class="form-control"
                               value="{{ old('customer_name', Auth::user()->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email</label>
                        <input type="email" name="customer_email" class="form-control"
                               value="{{ old('customer_email', Auth::user()->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Téléphone</label>
                        <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Adresse de livraison</label>
                        <textarea name="customer_address" class="form-control" rows="3" required>{{ old('customer_address') }}</textarea>
                    </div>
                    <button class="btn btn-success w-100 py-2 fw-semibold">
                        Continuer vers le paiement <i class="bi bi-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Récapitulatif</h5>
                <ul class="list-group list-group-flush">
                    @foreach($cart as $item)
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>{{ $item['name'] }} <small class="text-muted">× {{ $item['quantity'] }}</small></span>
                            <span>{{ number_format($item['price'] * $item['quantity'], 2) }} €</span>
                        </li>
                    @endforeach
                </ul>
                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong class="text-success fs-5">{{ number_format($grandTotal, 2) }} €</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
