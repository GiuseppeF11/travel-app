@extends('layouts.guest')

@section('main-content')

    <h1 class="text-center title mb-5" style="color: #383E5E">MERIDIANO</h1>

    <div class="row justify-content-center">
        <!-- Sezione Informazioni di Contatto -->
        <div class="col-md-6 mb-4">
            <h2>Contattaci</h2>
            <p class="fs-5">Hai domande, suggerimenti o hai bisogno di assistenza? Siamo qui per aiutarti!</p>
            <ul class="list-unstyled bg-secondary-subtle p-3 rounded-2 shadow">
                <li class="mb-2"><strong class="badge bg-secondary w-25 fs-6">Indirizzo</strong> <span class="fs-6">Via Roma 123, 00100 Roma, Italia</span></li>
                <li class="mb-2"><strong class="badge bg-secondary w-25 fs-6">Email</strong> <span class="fs-6">info@meridiano.com</span></li>
                <li class="mb-2"><strong class="badge bg-secondary w-25 fs-6">Telefono</strong> <span class="fs-6">+39 06 1234567</span></li>
            </ul>

            <!-- Messaggio di conferma fittizio -->
            <div class="alert alert-success d-none" id="success-message">
                Messaggio inviato con successo!
            </div>
        </div>

        <!-- Sezione Modulo di Contatto -->
        <div class="col-md-6">

            <form id="contact-form">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Oggetto</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Messaggio</label>
                    <textarea class="form-control" id="message" name="message" rows="2" required></textarea>
                </div>
                <button type="button" class="btn btn-1" onclick="showSuccessMessage()">Invia Messaggio</button>
            </form>
        </div>
    </div>

    <script>
        function showSuccessMessage() {
            document.getElementById('success-message').classList.remove('d-none');
        }
    </script>

@endsection

<style lang="scss" scoped>
    .title {        
        font-size: 70px;
        letter-spacing: 20px;
        text-shadow: 0px 3px 3px rgb(0, 0, 0);
    }

    form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }

    input, textarea {
        margin-bottom: 10px;
    }

    button {
        background-color: #383E5E;
        border: none;
    }

    button:hover {
        background-color: #2e3452;
    }

</style>
