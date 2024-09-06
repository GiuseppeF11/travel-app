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
                                <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-search text-light"></i> Filtra</button>
                            </div>
                        </div>
                        <a href="{{ route('admin.travels.create') }}" class="btn btn-1 btn-dark mb-3">
                            <i class="fa-solid fa-plus"></i> Aggiungi Viaggio
                        </a>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($travels->isEmpty())
                        <p>Nessun viaggio trovato.</p>
                    @else
                        <div class="custom-table">
                            <!-- Intestazione della tabella -->
                            <div class="custom-table-header">
                                <div class="custom-table-cell">Titolo</div>
                                <div class="custom-table-cell d-sm-none d-md-table-cell">Data Inizio</div>
                                <div class="custom-table-cell d-sm-none d-md-table-cell">Data Fine</div>
                                <div class="custom-table-cell">Luogo</div>
                                <div class="custom-table-cell">Azioni</div>
                            </div>

                            <!-- Righe della tabella -->
                            @foreach($travels as $travel)
                                <div class="custom-table-row" onclick="window.location.href='{{ route('admin.travels.show', $travel) }}'" style="
                                    background-image: url(
                                        @if (Str::startsWith($travel->img_file, 'https://'))
                                            '{{ $travel->img_file }}'
                                        @else
                                            '{{ asset('storage/' . $travel->img_file) }}'
                                        @endif
                                    );
                                    background-size: cover;
                                    background-position: center;
                                    background-repeat: no-repeat;
                                    color: #fff;
                                    ">
                                    <div class="custom-table-cell">{{ $travel->title }}</div>
                                    <div class="custom-table-cell d-sm-none d-md-table-cell">{{ $travel->start_date->format('d/m/Y') }}</div>
                                    <div class="custom-table-cell d-sm-none d-md-table-cell">{{ $travel->end_date->format('d/m/Y') }}</div>
                                    <div class="custom-table-cell">{{ Str::limit($travel->location, 50, '...') }}</div>
                                    <div class="custom-table-cell">
                                        {{-- <a href="{{ route('admin.travels.show', $travel) }}" class="btn btn-info btn-sm">
                                            <i class="fa-solid fa-eye fs-5 p-1"></i> Mostra
                                        </a> --}}
                                        <a href="{{ route('admin.travels.edit', $travel) }}" class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-file-pen fs-5 p-1"></i> Modifica
                                        </a>
                                        <!-- Modulo per la cancellazione -->
                                        <form id="delete-form-{{ $travel->id }}" action="{{ route('admin.travels.destroy', $travel->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm text-dark" onclick="showConfirmationModal({{ $travel->id }})">
                                                <i class="fa-solid fa-trash-can fs-5 p-1"></i> Elimina
                                            </button>
                                        </form>

                                        <!-- Modal di conferma -->
                                        <div id="confirmationModal" class="modal-overlay">
                                            <div class=" text-center bg-light text-dark rounded-2 p-5">
                                                <h5 class="mb-3">Sei sicuro di voler eliminare questo viaggio?</h5>
                                                <div class="d-flex gap-3 justify-content-center">
                                                    <button type="button" class="btn btn-secondary" onclick="closeConfirmationModal()">Annulla</button>
                                                    <button type="button" class="btn btn-danger" onclick="submitDeleteForm()">Elimina</button>
                                                </div>
                                            </div>
                                        </div>

                                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

                                        <script>
                                            let deleteFormId = null;

                                            function showConfirmationModal(formId) {
                                                deleteFormId = formId;
                                                document.getElementById('confirmationModal').style.display = 'flex';
                                            }

                                            function closeConfirmationModal() {
                                                document.getElementById('confirmationModal').style.display = 'none';
                                                deleteFormId = null;
                                            }

                                            function submitDeleteForm() {
                                                if (deleteFormId) {
                                                    document.getElementById('delete-form-' + deleteFormId).submit();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $travels->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<style lang="scss" scoped>
    .custom-table {
        display: table;
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table-header {
        display: table-row;
        background-color: #383E5E;
        color: #fff; 
        .custom-table-cell {
            height: 50px;
        }
    }

    .custom-table-row {
    display: table-row;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;

    &:hover {
        transform: scale(1.02);
        box-shadow: 0px 10px 10px black;
    }
}


    .custom-table-cell {
        display: table-cell;
        padding: 10px;
        vertical-align: middle;
        border-bottom: 1px solid #ddd;
        height: 150px;
        color: #fff;
        background-color: rgba(0, 0, 0, 0.5);
        font-size: 18px;
        font-weight: 700;          
    }

    .custom-table-row:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    /* Stile per l'intestazione */
    .custom-table-header .custom-table-cell {
        font-weight: bold;
        background-color: #383E5E;
    }

    .custom-table-header {
        color: white;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.529);
        align-items: center;
        justify-content: center;
        z-index: 1000;
        color: white;
    }
</style>
