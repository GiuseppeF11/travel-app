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
    // Salvataggio del percorso dell'immagine
    public function store(TravelRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('img_file')) {
            $file = $request->file('img_file');
            $path = $file->store('images', 'public'); // Salva l'immagine
            $validated['img_file'] = $path;
        }

        Travel::create(array_merge($validated, ['user_id' => Auth::id()]));

        return redirect()->route('admin.travels.index')->with('success', 'Viaggio creato con successo.');
    }






    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        // Verifica che il viaggio appartenga all'utente loggato
        if ($travel->user_id !== Auth::id()) {
            abort(403, 'Accesso non autorizzato');
        }

        return view('admin.travels.show', compact('travel'));
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
            $path = $file->store('images', 'public'); // Salva l'immagine nella directory 'storage/app/public/images'
            $validated['img_file'] = $path; // Memorizza il percorso del file

            // Rimuovi il vecchio file se necessario
            if ($travel->img_file && Storage::exists($travel->img_file)) {
                Storage::delete($travel->img_file);
            }
        }

        $travel->update($validated);

        return redirect()->route('admin.travels.index')->with('success', 'Viaggio aggiornato con successo.');
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

        $travel->delete();

        return redirect()->route('admin.travels.index')->with('success', 'Viaggio eliminato con successo.');
    }
}
