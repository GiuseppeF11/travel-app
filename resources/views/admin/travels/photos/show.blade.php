@extends('layouts.app')

@section('page-title', 'Dettagli Foto')

@section('main-content')
    <div class="container">
        <h1 class="text-center mb-4" style="color: #383E5E">
            Dettagli Foto
        </h1>

        <div class="card mb-4">
            <img src="{{ asset('storage/' . $photo->file_path) }}" class="card-img-top" alt="Foto">
            <div class="card-body">
                <h5 class="card-title">Descrizione</h5>
                <p class="card-text">{{ $photo->description }}</p>
                <a href="{{ route('travels.photos.edit', ['travel' => $photo->travel_id, 'photo' => $photo->id]) }}" class="btn btn-warning">
                    <i class="fa-solid fa-edit"></i> Modifica
                </a>
                <form action="{{ route('travels.photos.destroy', ['travel' => $photo->travel_id, 'photo' => $photo->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questa foto?')">
                        <i class="fa-solid fa-trash"></i> Elimina
                    </button>
                </form>
            </div>
        </div>

        <a href="{{ route('travels.photos.index', $photo->travel_id) }}" class="btn btn-secondary mt-3">
            <i class="fa-solid fa-arrow-left"></i> Torna all'Album
        </a>
    </div>
@endsection
