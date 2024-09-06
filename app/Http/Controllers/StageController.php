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

        $travelId = $request->query('travel_id');
        
        $travel = Travel::findOrFail($travelId);

    
        return view('admin.stages.create', [
            'travel' => $travel
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StageRequest $request)
    {
        // Valida i dati
        $validated = $request->validated();

        // Aggiungi esplicitamente il travel_id ai dati
        $validated['travel_id'] = $request->input('travel_id');

        // Crea la nuova tappa
        $stage = Stage::create($validated);

        // Redireziona con successo
        return redirect()->route('admin.travels.show', $validated['travel_id'])
                        ->with('success', 'Tappa aggiunta con successo.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
      
        return view('admin.stages.show', compact('stage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        $travel = Travel::find($stage->travel_id);

        return view('admin.stages.edit', compact('stage', 'travel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StageRequest $request, Stage $stage)
    {
        // Mostra i dati che sono stati validati
        $validated = $request->validated();

        // Aggiorna lo stage con i dati validati
        $stage->update($validated);

        // Reindirizza alla pagina del viaggio associato
        return redirect()->route('admin.travels.show', $stage->travel_id)
                        ->with('success', 'Tappa aggiornata con successo.');
    }


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        $travelId = $stage->travel_id;


        $stage->delete();

        return redirect()->route('admin.travels.show', $travelId)
                        ->with('success', 'Tappa eliminata con successo.');
    }
}
