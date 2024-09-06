@extends('layouts.app')

@section('page-title', 'Album di ' . $travel->title)

@section('main-content')
    <div class="container">
        <h1 class="text-center mb-4" style="color: #383E5E">
            Album - {{ $travel->title }}
        </h1>

        <!-- Form per il caricamento delle foto -->
        <form id="photoUploadForm" action="{{ route('admin.travels.photos.store', $travel->id) }}" method="POST" enctype="multipart/form-data" style="display: inline;">
            @csrf
            @method('POST')
            
            <!-- Input file per selezionare più file -->
            <input type="file" name="file_path[]" id="fileInput" class="d-none" accept="image/*" multiple>
            
            <!-- Pulsante per attivare l'input file -->
            <button type="button" class="btn btn-1 mb-3" id="uploadButton">
                <i class="fa-solid fa-plus text-light"></i> Aggiungi Foto
            </button>
        </form>

        <!-- Eliminazione multipla -->
        <form id="deletePhotosForm" action="{{ route('admin.travels.photos.bulkDestroy', $travel->id) }}" method="POST">
            @csrf

            <!-- Pulsante per eliminazione multipla -->
            <button type="submit" class="btn btn-danger mb-3" id="deleteSelectedButton">
                <i class="fa-solid fa-trash text-light"></i> Elimina
            </button>

            @if($photos->isEmpty())
                <h4>Nessuna foto presente per questo viaggio.</h4>
            @else
                <!-- Checkbox "Seleziona tutti" -->
                <div class="d-flex justify-content-end mb-2 gap-1">
                    <div class="badge bg-secondary p-2 fs-5">
                        <input class="checkbox" type="checkbox" id="selectAllCheckbox">
                            Seleziona tutti
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
                    @foreach($photos as $photo)
                        <div class="col mb-4">
                            <div class="card photo-card">
                                @if (Str::startsWith($photo->file_path, 'https://'))
                                    <img src="{{ $photo->file_path }}" class="card-img-top photo-img" alt="Foto">
                                @else
                                    <img src="{{ asset('storage/' . $photo->file_path) }}" class="card-img-top photo-img" alt="Foto">
                                @endif
                                <div class="card-body bg-secondary-subtle rounded-bottom-1">
                                    <p class="card-text">{{ $photo->description }}</p>
                                    <!-- Aggiungi checkbox per selezionare le foto da eliminare -->
                                    <div class="d-flex justify-content-end">
                                        <input class="checkbox" type="checkbox" name="photo_ids[]" value="{{ $photo->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="back-button">
                <a href="{{ route('admin.travels.show', $travel->id) }}" class="btn btn-secondary mt-3 ">
                    <i class="fa-solid fa-arrow-left text-light"></i> Torna ai Viaggi
                </a>
            </div>
        </form>        

        <!-- Overlay per l'anteprima a tutto schermo -->
        <div id="overlay" class="overlay">
            <button id="closeButton" class="close-btn">&times;</button>
            <button id="prevButton" class="nav-btn prev-btn">&#10094;</button>
            <img id="fullScreenImage" class="full-screen-image" src="" alt="Anteprima">
            <button id="nextButton" class="nav-btn next-btn">&#10095;</button>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Gestore di clic per aprire l'anteprima delle foto
    document.querySelectorAll('.photo-img').forEach((img, index) => {
        img.addEventListener('click', function() {
            openFullScreen(this.src, index);
        });
    });

    // Eventi per i pulsanti di navigazione
    document.getElementById('closeButton').addEventListener('click', closeFullScreen);
    document.getElementById('prevButton').addEventListener('click', showPrevImage);
    document.getElementById('nextButton').addEventListener('click', showNextImage);

    // Gestore di clic per il pulsante di upload
    document.getElementById('uploadButton').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    // Gestore di cambiamento per l'input file
    document.getElementById('fileInput').addEventListener('change', function() {
        if (this.files.length > 0) {
            document.getElementById('photoUploadForm').submit();
        }
    });

    // Gestore di clic per il checkbox "Seleziona tutti"
    document.getElementById('selectAllCheckbox').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="photo_ids[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    });

    let currentImageIndex = null;
    let images = [];

    function openFullScreen(imageSrc, index) {
        const overlay = document.getElementById('overlay');
        const fullScreenImage = document.getElementById('fullScreenImage');
        const imageElements = document.querySelectorAll('.photo-img');

        images = Array.from(imageElements).map(img => img.src);
        currentImageIndex = index;

        fullScreenImage.src = imageSrc;
        overlay.style.display = 'flex';
    }

    function closeFullScreen() {
        const overlay = document.getElementById('overlay');
        overlay.style.display = 'none';
    }

    function showPrevImage() {
        if (currentImageIndex > 0) {
            currentImageIndex--;
        } else {
            currentImageIndex = images.length - 1;
        }
        updateFullScreenImage();
    }

    function showNextImage() {
        if (currentImageIndex < images.length - 1) {
            currentImageIndex++;
        } else {
            currentImageIndex = 0;
        }
        updateFullScreenImage();
    }

    function updateFullScreenImage() {
        const fullScreenImage = document.getElementById('fullScreenImage');
        fullScreenImage.style.opacity = 0; // Fade out
        setTimeout(() => {
            fullScreenImage.src = images[currentImageIndex];
            fullScreenImage.style.opacity = 1; // Fade in
        }, 300);
    }

</script>

<style lang="scss" scoped>
.checkbox {
    scale: 1.3;
}

.photo-img {
    height: 200px; 
    object-fit: cover; 
    width: 100%; 
    cursor: pointer;
    transition: linear 0.2s;

    &:hover {
        filter: brightness(60%)
    }
}

.card {
    border: 1px solid #ddd;
    border-radius: 0.375rem; 
    position: relative; 
    overflow: hidden;
}

.card-img-top {
    height: 200px; 
    object-fit: cover;
}

.card-body {
    padding: 1rem; 
}

.col-md-3 {
    flex: 0 0 25%;
    max-width: 25%;
}

/* Stili per l'anteprima a tutto schermo */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8); 
    align-items: center;
    justify-content: center;
    z-index: 1000;
    overflow: hidden; 
}

.full-screen-image {
    max-width: 70%;
    max-height: 60%;
    object-fit: contain; 
    transition: opacity 0.3s ease;
}

/* Pulsanti di navigazione */
.nav-btn {
    position: absolute;
    top: 50%;
    background: rgba(0, 0, 0, 0.5); 
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 80px;
    height: 80px;
    font-size: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1001; 
    transition: background 0.3s ease;
}

.prev-btn {
    left: 100px;
}

.next-btn {
    right: 100px;
}

.nav-btn:hover {
    background: rgba(0, 0, 0, 0.8);
}

.close-btn {
    position: absolute;
    top: 130px;
    right: 300px;
    background: rgba(0, 0, 0, 0.5); 
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    font-size: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1001; 
}

.close-btn:hover {
    background: rgba(0, 0, 0, 0.8);
}

.back-button {
    position: fixed;
    bottom: 20px;
    right: 50px;
}
</style>
