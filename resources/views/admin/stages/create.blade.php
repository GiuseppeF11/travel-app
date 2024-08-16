@extends('layouts.app')

@section('page-title', 'Aggiungi Nuova Tappa')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Aggiungi Nuova Tappa</h1>

                <form action="{{ route('admin.stages.store') }}" method="POST">
                    @csrf

                    <!-- Campo nascosto per l'ID del viaggio -->
                    <input type="hidden" name="travel_id" value="{{ $travel->id }}">

                    <div class="form-group">
                        <label for="travel_id">Viaggio</label>
                        <!-- Mostra solo il titolo del viaggio senza possibilità di modifica -->
                        <input type="text" id="travel_id" class="form-control" value="{{ $travel->title }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="title">Nome Tappa</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="stage_start_date">Data Inizio</label>
                        <input type="date" name="stage_start_date" id="stage_start_date" class="form-control" value="{{ old('stage_start_date') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="stage_end_date">Data Fine</label>
                        <input type="date" name="stage_end_date" id="stage_end_date" class="form-control" value="{{ old('stage_end_date') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="start_time">Ora Inizio (opzionale)</label>
                        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}">
                    </div>

                    <div class="form-group">
                        <label for="end_time">Ora Fine (opzionale)</label>
                        <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Note</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Salva Tappa</button>
                    <a href="{{ route('admin.stages.index') }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
@endsection
