@extends('layouts.app')

@section('page-title', 'Dettagli Viaggio')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $travel->title }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Data Inizio:</strong> {{ $travel->start_date->format('d/m/Y') }}</p>
                    <p><strong>Data Fine:</strong> {{ $travel->end_date->format('d/m/Y') }}</p>
                    <p><strong>Luogo:</strong> {{ $travel->location }}</p>
                    <p><strong>Descrizione:</strong> {{ $travel->description }}</p>
                    <p><strong>Immagine:</strong> <br> 
                        @if (Str::startsWith($travel->img_file, 'https://'))
                            <!-- Caso 2: URL esterno -->
                            <img src="{{ $travel->img_file }}" alt="{{ $travel->title }}">
                        @else
                            <!-- Caso 1: File nella cartella storage -->
                            <img src="{{ asset('storage/' . $travel->img_file) }}" alt="{{ $travel->title }}">
                        @endif
                    </p>
                    
                        
                    
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.travels.edit', $travel->id) }}" class="btn btn-warning">Modifica</a>
                    <a href="{{ route('admin.travels.index') }}" class="btn btn-secondary">Torna all'elenco</a>
                </div>
            </div>
        </div>
    </div>
@endsection


<style lang="scss" scoped>
    img{
        max-width: 300px;
    }
</style>
