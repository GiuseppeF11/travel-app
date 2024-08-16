@extends('layouts.app')

@section('page-title', 'Lista delle Tappe')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Lista delle Tappe</h1>
                <a href="{{ route('admin.stages.create') }}" class="btn btn-primary mb-3">Aggiungi Nuova Tappa</a>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($stages->count())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Data Inizio</th>
                                <th>Data Fine</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stages as $stage)
                                <tr>
                                    <td>{{ $stage->title }}</td>
                                    <td>{{ $stage->stage_start_date->format('d/m/Y') }}</td>
                                    <td>{{ $stage->stage_end_date->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.stages.show', $stage->id) }}" class="btn btn-info">Visualizza</a>
                                        <a href="{{ route('admin.stages.edit', $stage->id) }}" class="btn btn-warning">Modifica</a>
                                        <form action="{{ route('admin.stages.destroy', $stage->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questa tappa?')">Elimina</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Non ci sono tappe disponibili.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
