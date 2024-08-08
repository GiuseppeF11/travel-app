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
                    <form action="{{ route('admin.travels.update', $travel->id) }}" method="POST">
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
                            <label for="img_url">Immagine URL</label>
                            <input type="url" name="img_url" id="img_url" class="form-control" value="{{ old('img_url', $travel->img_url) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Aggiorna Viaggio</button>
                        <a href="{{ route('admin.travels.index') }}" class="btn btn-secondary">Annulla</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
