@extends('layouts.app')

@section('page-title', 'Modifica Viaggio')

@section('main-content')


    <div class="container w-50 rounded">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3>Modifica Viaggio: {{ $travel->title }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.travels.update', $travel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <div class="form-group mb-3">
                                <label for="title">Titolo</label><span class="text-danger">*</span>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $travel->title) }}" required>
                            </div>
    
                            <div class="form-group mb-3">
                                <label for="start_date">Data Inizio</label><span class="text-danger">*</span>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $travel->start_date->format('Y-m-d')) }}" required>
                            </div>
    
                            <div class="form-group mb-3">
                                <label for="end_date">Data Fine</label><span class="text-danger">*</span>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $travel->end_date->format('Y-m-d')) }}" required>
                            </div>
    
                            <div class="form-group mb-3">
                                <label for="location">Luogo</label><span class="text-danger">*</span>
                                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $travel->location) }}" required autocomplete="off">
                                <!-- Div per mostrare i suggerimenti -->
                                <div id="suggestions" class="list-group mt-2"></div>
                            </div>
    
                            <div class="form-group mb-3">
                                <label for="description">Note</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $travel->description) }}</textarea>
                            </div>
    
                            <div class="form-group mb-3">
                                <label for="img_file">Immagine</label><span class="text-danger">*</span>
                                <input type="file" name="img_file" id="img_file" class="form-control" accept="image/*" required>
                            
                                <!-- Mostra l'anteprima dell'immagine esistente -->
                                <div class="my-2">
                                    @php
                                        $imageUrl = $travel->img_file && strpos($travel->img_file, 'https://') === 0
                                            ? $travel->img_file
                                            : (file_exists(public_path('storage/' . $travel->img_file)) ? asset('storage/' . $travel->img_file) : null);
                                    @endphp
                            
                                    <!-- Mostra l'immagine esistente se c'è -->
                                    @if ($imageUrl)
                                        <img id="image-preview" src="{{ $imageUrl }}" alt="{{ $travel->title }}" style="max-width: 300px;">
                                    @else
                                        <!-- Mostra un placeholder se non c'è immagine -->
                                        <p>Nessuna immagine caricata</p>
                                    @endif
                                </div>
                            </div>
                            
    
                            <button type="submit" class="btn btn-1">Aggiorna Viaggio</button>
                            <a href="{{ route('admin.travels.index') }}" class="btn btn-secondary">Annulla</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<script>
    // Gestisci l'anteprima dell'immagine quando viene selezionata una nuova
    document.getElementById('img_file').addEventListener('change', function(event) {
        var input = event.target;
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var imgPreview = document.getElementById('image-preview');
            imgPreview.src = e.target.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>

    <!-- Aggiungi il codice JavaScript per l'autocompletamento -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const locationInput = document.getElementById('location');
            const suggestions = document.getElementById('suggestions');

            locationInput.addEventListener('input', function () {
                const query = locationInput.value;

                if (query.length > 2) {
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            suggestions.innerHTML = '';

                            data.forEach(item => {
                                const option = document.createElement('a');
                                option.classList.add('list-group-item', 'list-group-item-action');
                                option.textContent = item.display_name;
                                option.addEventListener('click', function() {
                                    locationInput.value = item.display_name;
                                    suggestions.innerHTML = '';
                                });

                                suggestions.appendChild(option);
                            });
                        });
                } else {
                    suggestions.innerHTML = '';
                }
            });
        });

        // Anteprima immagine
        document.getElementById('img_file').addEventListener('change', function(event) {
            var input = event.target;
            var file = input.files[0];
            var reader = new FileReader();
            
            reader.onload = function(e) {
                var imgPreview = document.getElementById('image-preview');
                imgPreview.src = e.target.result;
            }
            
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

<style lang="scss" scoped>
    img {
        max-width: 300px;
    }

    .card-body {
        max-height: 70vh;
        overflow: auto;
    }
</style>
