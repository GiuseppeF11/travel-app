<!-- resources/views/admin/travels/index.blade.php -->

@extends('layouts.app')

@section('page-title', 'I Tuoi Viaggi')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>I Tuoi Viaggi</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.travels.create') }}" class="btn btn-primary mb-3">Aggiungi Nuovo Viaggio</a>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($travels->isEmpty())
                        <p>Nessun viaggio trovato.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titolo</th>
                                    <th>Data Inizio</th>
                                    <th>Data Fine</th>
                                    <th>Luogo</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($travels as $travel)
                                    <tr>
                                        <td>{{ $travel->title }}</td>
                                        <td>{{ $travel->start_date->format('d/m/Y') }}</td>
                                        <td>{{ $travel->end_date->format('d/m/Y') }}</td>
                                        <td>{{ $travel->location }}</td>
                                        <td>
                                            <a href="{{ route('admin.travels.show', $travel) }}" class="btn btn-info btn-sm">Mostra</a>
                                            <a href="{{ route('admin.travels.edit', $travel) }}" class="btn btn-warning btn-sm">Modifica</a>
                                            <form action="{{ route('admin.travels.destroy', $travel) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo viaggio?')">Elimina</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
