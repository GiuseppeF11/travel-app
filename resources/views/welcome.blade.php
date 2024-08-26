@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center" style="color: #383E5E">MERIDIANO</h1>
                    <div class="logo">
                    </div>
                    <br>
                    <p class="text-center">La prima app per organizzare e rivivere i propri viaggi in tutta comodità</p>

                    <div class="row">
                        <div class="col d-flex justify-content-center gap-2">
                            <a class="btn btn-dark" href="{{ route('login') }}">Accedi</a>
                            <a class="btn btn-dark" href="{{ route('register') }}">Registrati</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style lang="scss" scoped>

.logo {
    height: 500px;
    width: 500px;
    background-image: url(/images/Logo_Meridiano.png);
    object-fit: cover;
    background-position: center
}

</style>