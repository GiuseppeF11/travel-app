<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('images/Logo_Meridiano.png') }}">

        {{-- FONT AWESOME --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- SWIPER --}}
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


        <title>@yield('page-title') | {{ config('app.name', 'Meridiano') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>

    <?php
        $page_links = [
            [
                'name' => 'Viaggi',
                'url' => route('admin.travels.index')
            ],
            [
                'name' => 'Aggiungi Viaggi',
                'url' => route('admin.travels.create')
            ],
        ];
    ?>
    <body>
        <header>
            <nav class="p-0 navbar h-100 navbar-expand-lg bg-body-tertiary fs-5">
                <div class="container">
                    <a class="logo" href="{{ route('admin.travels.index') }}">
                        <img src="/images/Logo_Meridiano.png" alt="logo.meridiano">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link link-header" href="{{ route('admin.travels.index') }}"><i class="fa-solid fa-plane-departure "></i><span> Viaggi</span></a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.travels.index') }}"><i class="fa-solid fa-gear "></i> <span>Impostazioni</span></a>
                            </li> --}}
                        </ul>
                        <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" class="link-header text-danger">
                                Esci
                            </a>
                        </form>
                        
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-5 bg-image">
            <div class="container">
                @yield('main-content')
            </div>
        </main>

        <footer>

            <div class="container w-25">
                <div class="row pt-4 pb-1 text-center d-sm-none d-md-flex">
                    <div class="col">
                        <ul>
                            @foreach (array_slice($page_links, 0, 1) as $link) 
                                <li class="mb-2">
                                    <a class="link-footer" href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col">
                        <ul>
                            @foreach (array_slice($page_links, 1) as $link)
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
    </body>
</html>


<style lang="scss" scoped>
        .logo {
            width: 60px;
            height:100%;
            img {
                width: 100%;
                height: 100%;
                border-radius: 100%;
            }
        }

        .link {
        text-decoration: none;
        font-size: 15px;
        padding: 5px 10px;
        color: white;
        position: relative;
    }

    .link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: rgb(255, 255, 255);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease-in-out;
    }

    .link:hover::before {
        transform: scaleX(1);
    }

</style>
