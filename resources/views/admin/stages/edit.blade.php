@extends('layouts.app')

@section('page-title', 'Modifica Tappa')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Modifica Tappa: {{ $stage->title }}</h1>

                <form action="{{ route('admin.stages.update', $stage->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="stage_start_date">Data Inizio</label>
                        <input type="date" name="stage_start_date" id="stage_start_date" class="form-control" value="{{ old('stage_start_date', $stage->stage_start_date->format('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="stage_end_date">Data Fine</label>
                        <input type="date" name="stage_end_date" id="stage_end_date" class="form-control" value="{{ old('stage_end_date', $stage->stage_end_date->format('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="start_time">Ora Inizio (opzionale)</label>
                        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', $stage->start_time ? $stage->start_time->format('H:i') : '') }}">
                    </div>

                    <div class="form-group">
                        <label for="end_time">Ora Fine (opzionale)</label>
                        <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time', $stage->end_time ? $stage->end_time->format('H:i') : '') }}">
                    </div>

                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $stage->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Descrizione (opzionale)</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $stage->description) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Aggiorna Tappa</button>
                    <a href="{{ route('admin.travels.show', ['travel' => $stage->travel_id]) }}" class="btn btn-secondary">Annulla</a>
                </form>
            </div>
        </div>
    </div>
@endsection
