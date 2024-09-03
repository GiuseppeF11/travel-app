@extends('layouts.app')

@section('page-title', 'Dettagli Viaggio')

@section('main-content')
    <div class="row w-75 m-auto">
        <div class="col">
            <div class="card">
                <div class="card-header bg-dark-subtle justify-content-between d-flex">
                    <h3 class="color-1">{{ $travel->title }}</h3>
                    <div>
                        <a href="{{ route('admin.travels.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left text-light"></i> Torna all'elenco</a>
                        <a href="{{ route('admin.travels.edit', $travel->id) }}" class="btn btn-warning"><i class="fa-solid fa-file-pen"></i> Modifica</a>
                        <a href="{{ route('admin.stages.create', ['travel_id' => $travel->id]) }}" class="btn btn-1 btn-dark"><i class="fa-solid fa-plus"></i> Aggiungi Tappa</a>
                    </div>
                </div>
                <div class="card-body" id="card-body">
                    {{-- SEZIONE DETTAGLI VIAGGIO --}}
                    <section class="row mb-3">
                        <div class="col p-4 cover_image" style="
                            background-image: url(
                                @if (Str::startsWith($travel->img_file, 'https://'))
                                    '{{ $travel->img_file }}'
                                @else
                                    '{{ asset('storage/' . $travel->img_file) }}'
                                @endif
                            );">
                            <div class="travel_details">
                                <p><strong class="badge bg-gradient bg-secondary fs-6"><i class="fa-solid fa-calendar-days text-light"></i> Periodo</strong> {{ $travel->start_date->format('d/m/Y') }} - {{ $travel->end_date->format('d/m/Y')}}</p>
                                <p><strong class="badge bg-gradient bg-secondary fs-6"><i class="fa-solid fa-location-dot text-light"></i> Luogo</strong> {{ $travel->location }}</p>
                                <p><strong class="badge bg-gradient bg-secondary fs-6"><i class="fa-solid fa-note-sticky text-light"></i> Note</strong> {{ $travel->description }}</p>
                            </div>
                        </div>
                    </section>
                    

                    {{-- SEZIONE FOTO --}}
                    <section class="">
                        <div class="d-flex gap-3">
                            <form class="p-0 m-0"  id="photoUploadForm" action="{{ route('admin.travels.addPhotos', $travel->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <input type="file" name="photos[]" multiple class="d-none" id="photos" accept="image/*">
                            
                                <button type="button" class="btn btn-1" id="uploadButton"><i class="fa-regular fa-image"></i> Aggiungi Foto</button>
                            </form>

                            <a href="{{ route('admin.travels.photos.index', ['travel' => $travel->id]) }}" class="btn btn-success"><i class="fa-regular fa-images text-light"></i> Album</a>

                        </div>
                        
                        <script>
                            // Quando si clicca sul bottone "Aggiungi Foto"
                            document.getElementById('uploadButton').addEventListener('click', function() {
                                // Attiva il click sull'input file nascosto
                                document.getElementById('photos').click();
                            });
                        
                            // Quando l'utente seleziona i file
                            document.getElementById('photos').addEventListener('change', function() {
                                // Controlla se ci sono file selezionati
                                if (this.files.length > 0) {
                                    // Invia il form automaticamente
                                    document.getElementById('photoUploadForm').submit();
                                }
                            });
                        </script>
                        
                        
                        
                        
                        {{-- CAROSELLO --}}
                        <section class="mb-5 mt-3 carousel">
                            <h2 class="color-1">Album</h2>
                            
                            @if($travel->photos->isNotEmpty())
                                <div id="travelPhotosSwiper" class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach($travel->photos as $photo)
                                            <div class="swiper-slide">
                                                @if (Str::startsWith($photo->file_path, 'https://'))
                                                    <img src="{{ $photo->file_path }}" class="d-block w-50 m-auto rounded-2" alt="Foto">
                                                @else
                                                    <img src="{{ asset('storage/' . $photo->file_path) }}" class="d-block w-50 m-auto rounded-2" alt="Foto">
                                                @endif
                                                @if(!empty($photo->description))
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <p>{{ $photo->description }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next text-secondary p-5"></div>
                                    <div class="swiper-button-prev text-secondary p-5"></div>
                                </div>
                            @else
                                <p>Nessuna foto nell'album.</p>
                            @endif
                        </section>
                        
                        
                        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
                        <script>
                            var swiper = new Swiper('#travelPhotosSwiper', {
                                loop: true,
                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                },
                                autoplay: {
                                    delay: 3000, 
                                    disableOnInteraction: false,
                                },
                            });
                        </script>                        
                    </section>       
                                       

                    {{-- SEZIONE TAPPE DEL VIAGGIO --}}
                    <section class="py-4">
                        <h4 class="bg-dark-subtle p-2 my-0 border-2 rounded-2 rounded-bottom-0 color-1">Tappe</h4>
                        <div class="stages">
                            @if($stages->isEmpty())
                                <p>Non ci sono tappe per questo viaggio.</p>
                            @else

                            <div class="container p-0">
                                <div class="">
                                    @foreach($stages as $stage)
    <li class="list-group-item rounded-0 p-3 border mb-3 rounded-2">
        <h5 class=" text-decoration-underline">{{ $stage->title }}</h5>
        <p><strong class="badge bg-gradient bg-secondary fs-6"><i class="fa-solid fa-calendar-days text-light"></i> Periodo</strong> {{ $stage->stage_start_date->format('d/m/Y') }} - {{ $stage->stage_end_date->format('d/m/Y') }}</p>
        <p><strong class="badge bg-gradient bg-secondary fs-6"><i class="fa-solid fa-clock text-light"></i> Orario</strong> {{ $stage->start_time ? $stage->start_time->format('H:i') : 'N/A' }} - {{ $stage->end_time ? $stage->end_time->format('H:i') : 'N/A' }}</p>                                        
        <p><strong class="badge bg-gradient bg-secondary fs-6"><i class="fa-solid fa-note-sticky text-light"></i> Note</strong>  {{ $stage->description ?? 'N/A' }}</p>
        <a href="{{ route('admin.stages.show', $stage->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i> Dettagli</a>
        <a href="{{ route('admin.stages.edit', $stage->id) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-file-pen"></i> Modifica</a>

        <!-- Modulo per la cancellazione -->
        <form id="delete-form-{{ $stage->id }}" action="{{ route('admin.stages.destroy', $stage->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger btn-sm text-dark" onclick="showConfirmationModal({{ $stage->id }})">
                <i class="fa-solid fa-trash-can"></i> Elimina
            </button>
        </form>

        <!-- Modal di conferma -->
        <div id="confirmationModal-{{ $stage->id }}" class="modal-overlay">
            <div class=" text-center bg-light text-dark rounded-2 p-5">
                <h5>Conferma eliminazione</h5>
                <p>Sei sicuro di voler eliminare questa tappa?</p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-secondary" onclick="closeConfirmationModal({{ $stage->id }})">Annulla</button>
                    <button type="button" class="btn btn-danger" onclick="submitDeleteForm({{ $stage->id }})">Elimina</button>
                </div>
            </div>
        </div>
    </li>
@endforeach

<script>
    function showConfirmationModal(stageId) {
        document.getElementById('confirmationModal-' + stageId).style.display = 'flex';
    }

    function closeConfirmationModal(stageId) {
        document.getElementById('confirmationModal-' + stageId).style.display = 'none';
    }

    function submitDeleteForm(stageId) {
        document.getElementById('delete-form-' + stageId).submit();
    }
</script>

                                </div>

                            </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

<style lang="scss" scoped>
    .card {
        min-height: 80vh;
    }

    #card-body {
        padding: 0 12;
    }
    .cover_image {
        position: relative;
        width: 250px;
        height: 250px;
        overflow: hidden;
    }

    .cover_image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: inherit; 
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(3px) brightness(0.4); 
        background-blend-mode: darken;
        z-index: 1; 
    }

    .cover_image > * {
        position: relative;
        z-index: 2;
    }

    .travel_details{
        font-size: 20px;
        font-weight: 700;
        color: white;
    }


    .carousel {
        height: 300px;
        margin-bottom: 20px;
        
    }

    .carousel .swiper-container {
        height: 100%;
    }

    .carousel .swiper-slide {
        height: 100%;
    }

    .carousel .swiper-slide img {
        height: 100%;
        object-fit: cover;
    }

    .swiper-container {
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    .swiper-slide img {
        z-index: 1;
        position: relative;
    }

    .swiper-button-next, .swiper-button-prev {
        z-index: 10;
    }

    .carousel-caption {
        z-index: 5;
        position: relative;
    }

    .stages {
    max-height: 400px;
    overflow-y: auto;
    }

    .stages .list-group-item {
        word-wrap: break-word;
    }


    /* Sfondo scuro */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.529);
    align-items: center;
    justify-content: center;
    z-index: 1000;
    color: white;
}



</style>
