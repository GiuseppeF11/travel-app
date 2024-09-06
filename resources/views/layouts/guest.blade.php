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

    <?php
        $page_links = [
            [
                'name' => 'Chi Siamo?',
                'url' => route('page-details')
            ],
            [
                'name' => 'Contatti',
                'url' => route('contact-us')
            ],
            [
                'name' => 'Accedi',
                'url' => route('login')
            ],
            [
                'name' => 'Registrati',
                'url' => route('register')
            ]
        ];
    ?>

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
                                <li class="nav-item link fs-5">
                                    <a class="nav-link link-header" href="{{ route('page-details') }}">Chi siamo?</a>
                                </li>
                                <li class="nav-item link fs-5">
                                    <a class="nav-link link-header" href="{{ route('contact-us') }}">Contatti</a>
                                </li>
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


        <footer>

            <div class="container w-25">
                <div class="row pt-4 pb-1 text-center d-sm-none d-md-flex ">
                    <div class="col">
                        <ul>
                            @foreach (array_slice($page_links, 0, 2) as $link)
                                <li class="mb-2">
                                    <a class="link-footer" href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col">
                        <ul>
                            @foreach (array_slice($page_links, 2) as $link)
                                <li class="mb-2">
                                    <a class="link-footer" href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <div class="row fw-light" style="color:#FFBB00; height: 100px;" >
                    <div class="col text-center h-100 d-flex align-items-center justify-content-center">
                        <div>&copy; 2015 ItsCopyright</div>
                    </div>
                </div>
            </div>

        </footer>



        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

    </body>
</html>


<style lang="scss" scoped>

    

    .logo {
        width: 70px;
        img {
            width:100%;
        }
    }

    
</style>