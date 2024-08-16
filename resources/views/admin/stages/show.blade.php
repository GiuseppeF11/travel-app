@extends('layouts.app')

@section('page-title', 'Dettagli Tappa')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $stage->travel->title }} - {{ $stage->title }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Viaggio:</strong> {{ $stage->travel->title }}</p>
                    <p><strong>Data Inizio:</strong> {{ $stage->stage_start_date->format('d/m/Y') }}</p>
                    <p><strong>Data Fine:</strong> {{ $stage->stage_end_date->format('d/m/Y') }}</p>
                    <p><strong>Ora Inizio:</strong> {{ $stage->start_time ? $stage->start_time->format('H:i') : 'N/A' }}</p>
                    <p><strong>Ora Fine:</strong> {{ $stage->end_time ? $stage->end_time->format('H:i') : 'N/A' }}</p>
                    <p><strong>Descrizione:</strong> {{ $stage->description ?? 'N/A' }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.stages.edit', $stage->id) }}" class="btn btn-warning">Modifica</a>
                    <!-- Nuovo pulsante per tornare al viaggio associato -->
                    <a href="{{ route('admin.travels.show', $stage->travel_id) }}" class="btn btn-primary">Torna al Viaggio</a>
                </div>
            </div>
        </div>
    </div>
@endsection
