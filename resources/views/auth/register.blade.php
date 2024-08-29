@extends('layouts.guest')

@section('main-content')
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="card-body text-center">
                <h2 class="card-title mb-4">Registrati</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Nome
                        </label>
                        <input type="text" id="name" name="name" class="form-control rounded-pill @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>
                        <input type="email" id="email" name="email" class="form-control rounded-pill @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>
                        <input type="password" id="password" name="password" class="form-control rounded-pill @error('password') is-invalid @enderror" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            Conferma Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control rounded-pill" required>
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('login') }}" class="color-1">
                            Già registrato?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-1 px-4 rounded-pill">
                        Registrati
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
