@extends('layouts.guest')

@section('main-content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="card-body text-center">
                <h2 class="card-title mb-4">{{ __('Password dimenticata?') }}</h2>
                <p class="card-text mb-4">
                    Inserisci la tua <strong>email</strong> e ti invieremo un link per reimpostare la password.
                </p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Indirizzo Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Indirizzo Email
                        </label>
                        <input type="email" id="email" name="email" class="form-control rounded-pill" required autofocus>
                    </div>

                    <button type="submit" class="btn btn-primary px-4 rounded-pill">
                        {{ __('Invia il link') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
