@extends('layouts.app')

@section('page-title', 'Crea Nuovo Viaggio')

@section('main-content')
    <div class="row w-50 m-auto">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>Crea Nuovo Viaggio</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.travels.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="start_date">Data Inizio</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date">Data Fine</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Luogo</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Note</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="img_file">Carica Immagine</label>
                            <input type="file" name="img_file" id="img_file" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>
                            @error('img_file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <img id="img_preview" style="width: 300px" src="" alt="Anteprima Immagine" class="img-fluid">
                            </div>
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Crea Viaggio</button>
                        <a href="{{ route('admin.travels.index') }}" class="btn btn-secondary">Annulla</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('img_file').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('img_preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
