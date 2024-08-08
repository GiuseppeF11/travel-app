<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        // Validazione dei dati del viaggio
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:250',
            'description' => 'required|string',
            'img_url' => 'required|url',
        ]);

        // Creazione di un nuovo viaggio
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
    public function update(Request $request, Travel $travel)
    {
        // Verifica che il viaggio appartenga all'utente loggato
        if ($travel->user_id !== Auth::id()) {
            abort(403, 'Accesso non autorizzato');
        }

        // Validazione dei dati del viaggio
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:250',
            'description' => 'required|string',
            'img_url' => 'required|url',
        ]);

        // Aggiornamento del viaggio
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
