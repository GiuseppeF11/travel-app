@extends('layouts.app')

@section('page-title', 'Dettagli Viaggio')

@section('main-content')
    <div class="row w-75 m-auto">
        <div class="col">
            <div class="card">
                <div class="card-header bg-dark-subtle justify-content-between d-flex">
                    <h3>{{ $travel->title }}</h3>
                    <div>
                        <a href="{{ route('admin.travels.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left text-light"></i> Torna all'elenco</a>
                        <a href="{{ route('admin.travels.edit', $travel->id) }}" class="btn btn-warning"><i class="fa-solid fa-file-pen"></i> Modifica</a>
                        <a href="{{ route('admin.stages.create', ['travel_id' => $travel->id]) }}" class="btn btn-1 btn-dark"><i class="fa-solid fa-plus"></i> Aggiungi Tappa</a>
                    </div>
                </div>
                <div class="card-body">
                    <section class="row mb-3">
                        <div class="col">
                            <p><strong>Periodo:</strong> {{ $travel->start_date->format('d/m/Y') }} - {{ $travel->end_date->format('d/m/Y')}}</p>
                            <p><strong>Luogo:</strong> {{ $travel->location }}</p>
                            <p><strong>Note:</strong> {{ $travel->description }}</p>
                        </div>
                        <div class="col-auto">
                            <div class="cover_travel">
                                @if (Str::startsWith($travel->img_file, 'https://'))
                                <!-- Caso 1: URL esterno -->
                                <img class="border rounded-2 w-100" src="{{ $travel->img_file }}" alt="{{ $travel->title }}">
                                @else
                                    <!-- Caso 2: File nella cartella storage -->
                                    <img class=" border rounded-2 w-100" src="{{ asset('storage/' . $travel->img_file) }}" alt="{{ $travel->title }}">
                                @endif
                            </div>
                            
                        </div>
                    </section>

                    <section>
                        <form id="photoUploadForm" action="{{ route('admin.travels.addPhotos', $travel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Input file nascosto -->
                            <input type="file" name="photos[]" multiple class="d-none" id="photos" accept="image/*">
                            
                            <!-- Bottone per aprire il selettore di file -->
                            <button type="button" class="btn btn-primary" id="uploadButton"><i class="fa-solid fa-plus"></i> Aggiungi Foto</button>
                        </form>
                        
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
                        
                        
                        
                        
    
                        <section class="mb-5 carousel">
                            <h2>Album</h2>
                            <div id="travelPhotosCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($travel->photos as $index => $photo)
                                        <div class="carousel-item @if($index === 0) active @endif">
                                            @if (Str::startsWith($photo->file_path, 'https://'))
                                                <!-- Se l'URL inizia con https://, usalo direttamente -->
                                                <img src="{{ $photo->file_path }}" class="d-block w-50 m-auto rounded-2" alt="Foto">
                                            @else
                                                <!-- Se è un percorso relativo al 'storage', usa asset() -->
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
                                <button class="carousel-control-prev" type="button" data-bs-target="#travelPhotosCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark rounded-2" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#travelPhotosCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-dark rounded-2" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </section>
                        
                               
                        
                    </section>       
                                       

                    <!-- Sezione per visualizzare le tappe del viaggio -->
                    <h4 class="bg-dark-subtle p-2 my-0 border-2 rounded-2 rounded-bottom-0">Tappe</h4>
                    <div class="stages">
                        @if($stages->isEmpty())
                            <p>Non ci sono tappe per questo viaggio.</p>
                        @else

                        <div class="container p-0">
                            <div class="">
                                @foreach($stages as $stage)
                                    <li class="list-group-item rounded-0 p-3 border mb-3 rounded-2">
                                        <h5 class=" text-decoration-underline">{{ $stage->title }}</h5>
                                        <p><strong>Periodo:</strong> {{ $stage->stage_start_date->format('d/m/Y') }} - {{ $stage->stage_end_date->format('d/m/Y') }}</p>
                                        <p><strong>Orario:</strong> {{ $stage->start_time ? $stage->start_time->format('H:i') : 'N/A' }} - {{ $stage->end_time ? $stage->end_time->format('H:i') : 'N/A' }}</p>                                        
                                        <p><i class="fa-solid fa-clipboard"></i> {{ $stage->description ?? 'N/A' }}</p>
                                        <a href="{{ route('admin.stages.show', $stage->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i> Dettagli</a>
                                        <a href="{{ route('admin.stages.edit', $stage->id) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-file-pen"></i> Modifica</a>

                                        <!-- Form per eliminare la tappa -->
                                        <form action="{{ route('admin.stages.destroy', $stage->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm text-dark" onclick="return confirm('Sei sicuro di voler eliminare questa tappa?')"><i class="fa-solid fa-trash-can"></i> Elimina</button>
                                        </form>
                                    </li>
                                @endforeach
                            </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style lang="scss" scoped>
    .card {
        min-height: 80vh;
    }
    .cover_travel {
        width: 400px;
        img {
            width:100%;
        }
    }

    .carousel{
        height: 300px;
        margin-bottom:20px;

        .carousel-item {
            height:100%;

            img {
                height: 100%;
            }
        }
    }

    .stages {
    max-height: 400px;
    overflow-y: auto;
    }

    .stages .list-group-item {
        word-wrap: break-word;
    }

</style>
