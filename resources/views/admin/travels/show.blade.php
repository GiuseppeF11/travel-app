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

                    <!-- Sezione per visualizzare le tappe del viaggio -->
                    <div class="mt-4">
                        <h4>Tappe</h4>
                        @if($stages->isEmpty())
                            <p>Non ci sono tappe per questo viaggio.</p>
                        @else
                            <ul class="list-group">
                                @foreach($stages as $stage)
                                    <li class="list-group-item">
                                        <h5>{{ $stage->title }}</h5>
                                        <p><strong>Data Inizio:</strong> {{ $stage->stage_start_date->format('d/m/Y') }}</p>
                                        <p><strong>Data Fine:</strong> {{ $stage->stage_end_date->format('d/m/Y') }}</p>
                                        <p><strong>Ora Inizio:</strong> {{ $stage->start_time ? $stage->start_time->format('H:i') : 'N/A' }}</p>
                                        <p><strong>Ora Fine:</strong> {{ $stage->end_time ? $stage->end_time->format('H:i') : 'N/A' }}</p>
                                        <p><strong>Descrizione:</strong> {{ $stage->description ?? 'N/A' }}</p>
                                        <a href="{{ route('admin.stages.show', $stage->id) }}" class="btn btn-info btn-sm">Visualizza Dettagli</a>
                                        <a href="{{ route('admin.stages.edit', $stage->id) }}" class="btn btn-warning btn-sm">Modifica</a>

                                        <!-- Form per eliminare la tappa -->
                                        <form action="{{ route('admin.stages.destroy', $stage->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa tappa?')">Elimina</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.travels.edit', $travel->id) }}" class="btn btn-warning">Modifica</a>
                    <a href="{{ route('admin.travels.index') }}" class="btn btn-secondary">Torna all'elenco</a>
                    <!-- Nuovo pulsante per aggiungere una tappa -->
                    <a href="{{ route('admin.stages.create', ['travel_id' => $travel->id]) }}" class="btn btn-primary">Aggiungi Tappa</a>
                </div>
            </div>
        </div>
    </div>
@endsection

<style lang="scss" scoped>
    img {
        max-width: 300px;
    }
</style>
