@extends('layouts.app')

@section('page-title', 'Modifica Viaggio')

@section('main-content')
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

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $travel->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Data Inizio</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $travel->start_date->format('Y-m-d')) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">Data Fine</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $travel->end_date->format('Y-m-d')) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="location">Luogo</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $travel->location) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Descrizione</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $travel->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="img_file">Immagine</label>
                            <input type="file" name="img_file" id="img_file" class="form-control" accept="image/*">

                            <!-- Mostra l'anteprima dell'immagine esistente -->
                            <div class="mt-2">
                                <img id="image-preview" src="{{ asset('storage/' . $travel->img_file) }}" alt="{{ $travel->title }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Aggiorna Viaggio</button>
                        <a href="{{ route('admin.travels.index') }}" class="btn btn-secondary">Annulla</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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
    img{
        max-width: 300px;
    }
</style>
