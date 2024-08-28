<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Requests\TravelRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mostra solo i viaggi dell'utente loggato
        $travels = Travel::where('user_id', Auth::id())->get();
        return view('admin.travels.index', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.travels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TravelRequest $request)
    {
        $validated = $request->validated();

        // Aggiungi l'ID dell'utente loggato
        $validated['user_id'] = Auth::id();

        // Gestisci il caricamento dell'immagine principale
        if ($request->hasFile('img_file')) {
            $validated['img_file'] = $request->file('img_file')->store('images', 'public');
        }

        // Crea il viaggio
        $travel = Travel::create($validated);

        // Gestisci l'upload delle foto aggiuntive
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $travel->photos()->create([
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('travels.index')->with('success', 'Viaggio creato con successo.');
    }

    public function addPhotos(Request $request, Travel $travel)
    {
        $request->validate([
            'photos.*' => 'nullable|image|max:2048', // Validazione per le foto
        ]);

        // Gestisci l'upload delle foto
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $travel->photos()->create([
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.travels.show', $travel->id)->with('success', 'Foto aggiunte con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        // Recupera le tappe associate al viaggio
        $stages = $travel->stages()->orderBy('stage_start_date', 'asc')->get();
        
        return view('admin.travels.show', compact('travel', 'stages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
    {
        // Verifica che il viaggio appartenga all'utente loggato
        if ($travel->user_id !== Auth::id()) {
            abort(403, 'Accesso non autorizzato');
        }

        return view('admin.travels.edit', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TravelRequest $request, Travel $travel)
    {
        $validated = $request->validated();

        if ($request->hasFile('img_file')) {
            $file = $request->file('img_file');
            $path = $file->store('images', 'public');
            $validated['img_file'] = $path;

            // Rimuovi il vecchio file se necessario
            if ($travel->img_file && Storage::exists($travel->img_file)) {
                Storage::delete($travel->img_file);
            }
        }

        $travel->update($validated);

        return redirect()->route('admin.travels.show', $travel->id)->with('success', 'Viaggio aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travel $travel)
    {
        // Verifica che il viaggio appartenga all'utente loggato
        if ($travel->user_id !== Auth::id()) {
            abort(403, 'Accesso non autorizzato');
        }

        // Rimuovi l'immagine principale se presente
        if ($travel->img_file && Storage::exists($travel->img_file)) {
            Storage::delete($travel->img_file);
        }

        // Rimuovi le foto associate al viaggio
        foreach ($travel->photos as $photo) {
            if (Storage::exists($photo->file_path)) {
                Storage::delete($photo->file_path);
            }
            $photo->delete();
        }

        $travel->delete();

        return redirect()->route('admin.travels.index')->with('success', 'Viaggio eliminato con successo.');
    }
}
