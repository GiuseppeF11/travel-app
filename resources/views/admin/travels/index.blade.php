@extends('layouts.app')

@section('page-title', 'I Tuoi Viaggi')

@section('main-content')
    <h1 class="text-center" style="color: #383E5E">
        Ciao, {{ Auth::user()->name }}!
    </h1>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 style="color: #383E5E">I Tuoi Viaggi</h3>
                </div>
                <div class="card-body rounded-bottom-1">
                    <a href="{{ route('admin.travels.create') }}" class="btn btn-1 btn-dark mb-3"><i class="fa-solid fa-plus"></i> Aggiungi Viaggio</a>

                    <!-- Form di ricerca -->
                    <form action="{{ route('admin.travels.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="title">Nome viaggio</label>
                                <input type="text" name="title" class="form-control" placeholder="Cerca per titolo" value="{{ request('title') }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="start_date">Data inizio</label>
                                <input type="date" name="start_date" class="form-control" placeholder="Data Inizio" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="end_date">Data Fine</label>
                                <input type="date" name="end_date" class="form-control" placeholder="Data Fine" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-2 mb-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-search text-light"></i> Filtra</button>
                            </div>
                        </div>
                    </form>

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
                                            <a href="{{ route('admin.travels.show', $travel) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye fs-5 p-1"></i> Mostra</a>
                                            <a href="{{ route('admin.travels.edit', $travel) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-file-pen fs-5 p-1"></i> Modifica</a>
                                            <form action="{{ route('admin.travels.destroy', $travel) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm text-dark" onclick="return confirm('Sei sicuro di voler eliminare questo viaggio?')"><i class="fa-solid fa-trash-can fs-5 p-1"></i> Elimina</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $travels->links() }} <!-- Aggiungi paginazione -->
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


<style lang="scss" scoped>
    .table th,
    .table td {
        vertical-align: middle;
    }
    
    .table th {
        white-space: nowrap;
    }

    .table td:nth-child(1) {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .table td:nth-child(4) {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .table td:nth-child(5) {
        white-space: nowrap;
    }
    </style>
    