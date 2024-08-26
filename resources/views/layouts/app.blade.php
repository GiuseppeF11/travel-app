<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body>
        <header>
            <nav class="p-0 navbar h-100 navbar-expand-lg bg-body-tertiary">
                <div class="container">
                    <div class="logo">
                        <img src="/images/Logo_Meridiano.png" alt="logo.meridiano">
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.travels.index') }}"><i class="fa-solid fa-plane-departure "></i><span> Viaggi</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.travels.index') }}"><i class="fa-solid fa-gear "></i> <span>Impostazioni</span></a>
                            </li>
                        </ul>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="btn btn-outline-danger">
                                Esci
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4 bg-image">
            <div class="container">
                @yield('main-content')
            </div>
        </main>
    </body>
</html>


<style lang="scss" scoped>
    header {
        height: 10vh;

        .logo {
            width: 60px;
            height:100%;
            img {
                width: 100%;
                height: 100%;
                border-radius: 100%;
            }
        }
    }
    main {
        min-height: 90vh;
    }
    /* .bg-image {
    position: relative;
    z-index: 1;
}

.bg-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-image: url(https://static.vecteezy.com/system/resources/previews/015/414/382/non_2x/world-map-isolated-on-white-background-flat-earth-map-template-for-web-site-pattern-anual-report-inphographics-worldmap-icon-travel-worldwide-map-silhouette-vector.jpg);
    filter: brightness(0.7);
    z-index: -1;
} */


</style>
