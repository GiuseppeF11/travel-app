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
                            @if (Str::startsWith($travel->img_file, 'https://'))
                                <!-- Caso 1: URL esterno -->
                                <img class="border rounded-2" src="{{ $travel->img_file }}" alt="{{ $travel->title }}">
                            @else
                                <!-- Caso 2: File nella cartella storage -->
                                <img class="border rounded-2" src="{{ asset('storage/' . $travel->img_file) }}" alt="{{ $travel->title }}">
                            @endif
                        </div>
                    </section>
                               
                                       

                    <!-- Sezione per visualizzare le tappe del viaggio -->
                    <h4 class="bg-dark-subtle p-2 my-0 border-2 rounded-2 rounded-bottom-0">Tappe</h4>
                    <div class=" stages">
                        @if($stages->isEmpty())
                            <p>Non ci sono tappe per questo viaggio.</p>
                        @else
                            <ul class="list-group">
                                @foreach($stages as $stage)
                                    <li class="list-group-item rounded-0">
                                        <h5>{{ $stage->title }}</h5>
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
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style lang="scss" scoped>
    img {
        max-width: 500px;
    }

    .stages {
    max-height: 400px;
    overflow-y: auto;
    }

    .stages .list-group-item {
        word-wrap: break-word;
    }

</style>
