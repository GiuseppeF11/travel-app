<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class PhotoController extends Controller
{
    // Mostra tutte le foto di un determinato viaggio
    public function index(Request $request, $travel_id)
    {
        // Recupera il viaggio
        $travel = Travel::findOrFail($travel_id);

        // Recupera le foto associate a questo viaggio
        $photos = Photo::where('travel_id', $travel->id)->get();

        // Passa 'photos' e 'travel' alla vista
        return view('admin.travels.photos.index', compact('photos', 'travel'));
    }

    // Mostra il form per creare una nuova foto
    public function create($travel_id)
    {
        $travel = Travel::findOrFail($travel_id);
        return view('admin.travels.photos.create', compact('travel'));
    }

    // Salva una nuova foto nel database
    public function store(Request $request, $travel_id)
{
    $request->validate([
        'file_path.*' => 'required|image|max:2048', // Valida che ogni file sia un'immagine e non superi i 2MB
        'description' => 'nullable|string|max:255',
    ]);

    $files = $request->file('file_path');
    
    foreach ($files as $file) {
        // Salva il file sul server
        $path = $file->store('admin.travels/photos', 'public');

        // Crea una nuova istanza di Photo
        $photo = new Photo();
        $photo->travel_id = $travel_id;
        $photo->file_path = $path;
        $photo->description = $request->input('description');
        $photo->save();
    }

    // Assicurati di passare il parametro 'travel' corretto nel redirect
    return redirect()->route('admin.travels.photos.index', ['travel' => $travel_id])
                     ->with('success', 'Foto aggiunte con successo!');
}



    // Mostra una singola foto
    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        return view('admin.travels.photos.show', compact('photo'));
    }

    // Mostra il form per modificare una foto esistente
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('admin.travels.photos.edit', compact('photo'));
    }

    // Aggiorna una foto esistente
    public function update(Request $request, $id)
    {
        $request->validate([
            'file_path' => 'sometimes|image|max:2048', // Valida che sia un'immagine e che non superi i 2MB
            'description' => 'nullable|string|max:255',
        ]);

        $photo = Photo::findOrFail($id);

        // Se viene caricato un nuovo file, sostituisci il vecchio
        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('admin.travels.photos', 'public');
            $photo->file_path = $path;
        }

        $photo->description = $request->input('description');
        $photo->save();

        return redirect()->route('admin.travels.photos.index', ['travel' => $photo->travel_id])
                         ->with('success', 'Foto aggiornata con successo!');
    }

    public function destroy(Request $request, $travelId, $photoId)
    {
        $photo = Photo::findOrFail($photoId);
        $photo->delete();

        return redirect()->route('admin.travels.show', $travelId)
            ->with('success', 'Foto eliminata con successo!');
    }

    // PhotoController.php

    public function bulkDestroy(Request $request, $travelId)
    {
        $photoIds = $request->input('photo_ids', []);
        Photo::whereIn('id', $photoIds)->delete();

        return redirect()->route('admin.travels.photos.index', $travelId)
            ->with('success', 'Foto selezionate eliminate con successo!');
    }


}
