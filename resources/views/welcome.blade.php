@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">
                        TRAVEL APP
                    </h1>
                    <br>
                    <p class="text-center">La prima app per organizzare e rivivere i propri viaggi in tutta comodità</p>

                    <div class="row">
                        <div class="col d-flex justify-content-center gap-2">
                            <a class="btn btn-dark" href="{{ route('login') }}">Login</a>
                            <a class="btn btn-dark" href="{{ route('register') }}">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
