@extends('layouts.guest')

@section('main-content')
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="card-body text-center">
                <h2 class="card-title mb-4 color-1 ">Login</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>
                        <input type="email" id="email" name="email" class="form-control rounded-pill" required autofocus>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>
                        <input type="password" id="password" name="password" class="form-control rounded-pill" required>
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-3 text-start">
                        <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                        <label for="remember_me" class="form-check-label">
                            Ricordami
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="mb-3">
                            <a href="{{ route('password.request') }}" class="text-decoration-none color-1">
                                Password dimenticata?
                            </a>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-1 w-100 rounded-pill">
                        Accedi
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
