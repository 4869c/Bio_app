@extends('layouts.app')
@section('title', 'Connexion')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card border-0 shadow rounded-4">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <i class="bi bi-tree-fill text-success" style="font-size:2.5rem"></i>
                    <h3 class="fw-bold mt-2 mb-0">Bon retour !</h3>
                    <p class="text-muted small">Connectez-vous à votre compte</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger border-0">
                        @foreach($errors->all() as $err)
                            <div>{{ $err }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <button class="btn btn-success w-100 py-2 fw-semibold">
                        <i class="bi bi-box-arrow-in-right"></i> Se connecter
                    </button>
                </form>
                <p class="text-center mt-4 mb-0 small text-muted">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-success fw-semibold text-decoration-none">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
