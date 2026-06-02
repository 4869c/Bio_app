@extends('layouts.app')
@section('title', 'Inscription')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow rounded-4">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <i class="bi bi-tree-fill text-success" style="font-size:2.5rem"></i>
                    <h3 class="fw-bold mt-2 mb-0">Créer un compte</h3>
                    <p class="text-muted small">Rejoignez la communauté Bio Farms</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger border-0">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nom complet</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-semibold">Confirmer</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success w-100 py-2 fw-semibold">
                        <i class="bi bi-person-plus"></i> Créer mon compte
                    </button>
                </form>
                <p class="text-center mt-4 mb-0 small text-muted">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="text-success fw-semibold text-decoration-none">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
