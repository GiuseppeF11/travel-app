<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page-title') | {{ config('app.name', 'Meridiano') }}</title>

        <!-- Aggiungi il CSS di AOS nella sezione head -->
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">


        <link rel="icon" href="{{ asset('images/Logo_Meridiano.png') }}">

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary h-100 fs-5">
                <div class="container">
                    <a class="logo" href="/">
                        <img src="/images/Logo_Meridiano.png" alt="logo.meridiano">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @auth
                                
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('page-details') }}">Chi siamo?</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact-us') }}">Contatti</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Accedi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                                </li> --}}
                            @endauth
                        </ul>

                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-outline-danger">
                                    Esci
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <main class="">
            <div class="container">
                @yield('main-content')
            </div>
        </main>
        <!-- Aggiungi il JS di AOS prima della chiusura del body -->
        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

    </body>
</html>


<style lang="scss" scoped>

    header {
        height: 10vh;
        position: sticky;
        top: 0;
        z-index: 10001;
    }

    .logo {
        width: 70px;
        img {
            width:100%;
        }
    }


    main {
        background-image: url(/images/wallpaper.jpg);
        padding: 30px 0;
        min-height: 90vh;
        background-size: contain;
    }

</style>