<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Travel;
use App\Http\Requests\StageRequest;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Se necessario, decommenta e assicurati che funzioni correttamente.
    /*
    public function index(Request $request)
    {
        $travel_id = $request->get('travel_id');
        
        $stages = Stage::where('travel_id', $travel_id)->get();

        return view('admin.stages.index', compact('stages'));
    }
    */

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Recupera l'ID del viaggio dalla query string
        $travelId = $request->query('travel_id');
        
        // Trova il viaggio con l'ID fornito
        $travel = Travel::findOrFail($travelId);

        // Passa i dati alla vista
        return view('admin.stages.create', [
            'travel' => $travel
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StageRequest $request)
    {
        // I dati sono già validati
        $validated = $request->validated();

        // Crea la nuova tappa
        $stage = Stage::create($validated);

        // Reindirizza alla pagina di dettaglio del viaggio
        return redirect()->route('admin.travels.show', $validated['travel_id'])
                         ->with('success', 'Tappa aggiunta con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
        // Mostra i dettagli di una singola tappa
        return view('admin.stages.show', compact('stage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        // Mostra il form per modificare una tappa esistente
        return view('admin.stages.edit', compact('stage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StageRequest $request, Stage $stage)
    {
        // I dati sono già validati
        $validated = $request->validated();
    
        // Aggiorna la tappa esistente
        $stage->update($validated);
    
        // Recupera l'ID del viaggio associato alla tappa
        $travelId = $stage->travel_id;
    
        // Reindirizza alla pagina di dettaglio del viaggio
        return redirect()->route('admin.travels.show', $travelId)
                         ->with('success', 'Tappa aggiornata con successo.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        $travelId = $stage->travel_id;

        // Elimina la tappa
        $stage->delete();

        // Reindirizza alla pagina di dettaglio del viaggio
        return redirect()->route('admin.travels.show', $travelId)
                        ->with('success', 'Tappa eliminata con successo.');
    }
}
