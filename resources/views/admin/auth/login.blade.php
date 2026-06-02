@extends('layouts.admin')
@section('title', 'Admin Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-shield-lock"></i> Admin Login
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Admin Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-dark w-100">Login</button>
                </form>
                <p class="small text-muted mt-3 mb-0">
                    Default admin: <code>admin@bio.com</code> / <code>admin123</code>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
