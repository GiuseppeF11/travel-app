@extends('layouts.app')

@section('page-title', 'Modifica Tappa')

@section('main-content')
    <div class="container w-50 rounded">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3>Modifica Tappa: {{ $stage->title }}</h3>
                    </div>

                    {{-- @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    <div class="card-body">
                        <form action="{{ route('admin.stages.update', $stage->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @if(isset($travel) && $travel->id)
                                <input type="hidden" name="travel_id" value="{{ $travel->id }}">
                            @else
                                <div class="alert alert-danger">Nessun viaggio selezionato.</div>
                            @endif

                            <div class="form-group mb-3">
                                <label class="fw-bold" for="travel_id">Viaggio</label>
                                <!-- Mostra solo il titolo del viaggio senza possibilità di modifica -->
                                <input type="text" id="travel_id" class="form-control" value="{{ $travel->title }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="title">Nome Tappa</label><span class="text-danger">*</span>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $stage->title) }}" required>
                            </div>
                        
                            <div class="form-group mb-3">
                                <label for="stage_start_date">Data Inizio</label><span class="text-danger">*</span>
                                <input type="date" name="stage_start_date" id="stage_start_date" class="form-control" value="{{ old('stage_start_date', $stage->stage_start_date->format('Y-m-d')) }}" required>
                            </div>
                        
                            <div class="form-group mb-3">
                                <label for="stage_end_date">Data Fine</label><span class="text-danger">*</span>
                                <input type="date" name="stage_end_date" id="stage_end_date" class="form-control" value="{{ old('stage_end_date', $stage->stage_end_date->format('Y-m-d')) }}" required>
                            </div>
                        
                            <div class="form-group mb-3">
                                <label for="start_time">Ora Inizio</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', $stage->start_time ? $stage->start_time->format('H:i') : '') }}">
                            </div>
                        
                            <div class="form-group mb-3">
                                <label for="end_time">Ora Fine</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time', $stage->end_time ? $stage->end_time->format('H:i') : '') }}">
                            </div>
                        
                            <div class="form-group mb-3">
                                <label for="description">Note</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $stage->description) }}</textarea>
                            </div>
                        
                            <button type="submit" class="btn btn-1">Aggiorna Tappa</button>
                            <a href="{{ route('admin.travels.show', $stage->travel_id) }}" class="btn btn-secondary">Annulla</a>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style lang="scss" scoped>
    .card-body {
        max-height: 70vh;
        overflow: auto;
    }
</style>
