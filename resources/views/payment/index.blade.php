@extends('layouts.app')
@section('title', 'Paiement')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow rounded-4 overflow-hidden">
            <div class="p-4 text-white" style="background: linear-gradient(135deg,#386641,#6a994e);">
                <h4 class="fw-bold mb-0"><i class="bi bi-credit-card-2-front"></i> Paiement sécurisé</h4>
                <small class="opacity-75">Simulation de paiement</small>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-warning border-0 small">
                    <i class="bi bi-info-circle"></i>
                    <strong>Note :</strong> Page de paiement simulée pour un projet académique.
                    Aucune information bancaire réelle n'est traitée.
                </div>

                @if($errors->any())
                    <div class="alert alert-danger border-0">
                        @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('payment.pay') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Numéro de carte</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-credit-card"></i></span>
                            <input type="text" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" value="4242 4242 4242 4242" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Titulaire de la carte</label>
                        <input type="text" name="card_holder" class="form-control" placeholder="Jean Dupont" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold">Expiration</label>
                            <input type="text" name="expiry" class="form-control" placeholder="MM/AA" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold">CVV</label>
                            <input type="text" name="cvv" class="form-control" placeholder="123" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                        <i class="bi bi-lock-fill"></i> Payer maintenant
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
