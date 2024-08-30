@extends('layouts.guest')

@section('main-content')

    @php
        $images = [
            [
                'url' => 'https://static2-viaggi.corriereobjects.it/wp-content/uploads/2017/01/iStock-vacanze-famiglie.jpg?v=1485338479',
                'description' => "Con la nostra app, ogni viaggio diventa un ricordo eterno. Conserva ogni tappa, ogni emozione, e rievoca quei momenti speciali ogni volta che vuoi."
            ],
            [
                'url' => 'https://media.istockphoto.com/id/1500563478/photo/traveler-asian-woman-relax-and-travel-on-thai-longtail-boat-in-ratchaprapha-dam-at-khao-sok.webp?b=1&s=612x612&w=0&k=20&c=lctMEC3mxw_T1N1rk1eAx5c9NRddxUj8ncaMxtBpIDU=',
                'description' => "Pianifica il tuo itinerario perfetto e segna ogni tappa del tuo viaggio. La nostra app ti permette di creare mappe dettagliate dei tuoi percorsi, rendendo ogni avventura facile da rivivere."
            ],
            [
                'url' => 'https://previews.123rf.com/images/virtosmedia/virtosmedia2302/virtosmedia230252013/198748406-raccolta-di-foto-sul-tema-dei-viaggi-e-delle-vacanze-in-tailandia.jpg',
                'description' => "Crea album fotografici personalizzati e carica tutte le immagini dei tuoi viaggi. Raccogli i tuoi scatti più belli in un unico posto e condividili con chi vuoi."
            ],
            [
                'url' => 'https://media.istockphoto.com/id/1066472014/it/foto/vista-posteriore-di-una-famiglia-che-guarda-la-tv-sul-divano-a-casa.jpg?s=612x612&w=0&k=20&c=bFg4JtXI2KwzAHRkKiVWGhunELfREZnMDNCu-qI49JI=',
                'description' => "Rivivi ogni emozione con la nostra app. Basta un clic per tornare ai tuoi luoghi preferiti, sfogliare i ricordi e lasciarti ispirare dai tuoi viaggi passati."
            ],
        ];

    @endphp

    <h1 class="text-center title mb-5" style="color: #383E5E">MERIDIANO</h1>

    @foreach ($images as $index => $image)
        <section class="row color-1">
            @if ($index % 2 == 0)
                <div class="col d-flex align-items-center" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000">
                    <h2>{{ $image['description'] }}</h2>
                </div>
                <div class="col d-flex align-items-center" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000">
                    <img src="{{ $image['url'] }}" alt="Image {{ $index + 1 }}">
                </div>
            @else
                <div class="col d-flex align-items-center" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000">
                    <img src="{{ $image['url'] }}" alt="Image {{ $index + 1 }}">
                </div>
                <div class="col d-flex align-items-center" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000">
                    <h2>{{ $image['description'] }}</h2>
                </div>
            @endif
        </section>
    @endforeach

    <div class="row">
        <div class="col d-flex justify-content-center gap-2">
            <a class="btn btn-1 fs-4" href="{{ route('login') }}">Accedi</a>
            <a class="btn btn-1 fs-4" href="{{ route('register') }}">Registrati</a>
        </div>
    </div>


@endsection

<style lang="scss" scoped>
    .title {        
        font-size: 70px;
        letter-spacing: 20px;
        text-shadow: 0px 3px 3px rgb(0, 0, 0);
    }

    section {
        margin-bottom: 80px;
    }

    img {
        max-width: 100%;
        border-radius: 20px;
    }

</style>